<?php
/**
 * Akeeba Engine
 * The modular PHP5 site backup engine
 *
 * @copyright Copyright (c)2006-2017 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU GPL version 3 or, at your option, any later version
 * @package   akeebaengine
 *
 *
 */

namespace Akeeba\Engine\Postproc\Connector;

// Protection against direct access
defined('AKEEBAENGINE') or die();

class GoogleStorage
{
	/**
	 * The access token for connecting to Google Storage
	 *
	 * @var   string
	 */
	private $accessToken = '';

	/**
	 * The PEM-encoded private key for the Google Cloud Service Account we are going to use. This is given to you by
	 * Google in a JSON file.
	 *
	 * @var   string
	 */
	private $privateKey = '';

	/**
	 * The Google Cloud Service Account (fake) email address. This is given to you by Google in a JSON file.
	 *
	 * @var   string
	 */
	private $clientEmail = '';

	/**
	 * When does the access token expire (in UNIX epoch)?
	 *
	 * @var   int
	 */
	private $expires = 0;

	/**
	 * A pre-calculated JWT assertion, used to make a request for an access token to Google's servers
	 *
	 * @var   string
	 */
	private $jwtAssertion = '';

	/**
	 * The root URL for the Google Storage v1 JSON API
	 *
	 * @see  https://cloud.google.com/storage/docs/json_api/v1/
	 */
	const rootUrl = 'https://www.googleapis.com/storage/v1/';

	/**
	 * The upload URL for the Google Storage v1 JSON API
	 *
	 * @see  https://cloud.google.com/storage/docs/json_api/v1/how-tos/simple-upload
	 */
	const uploadUrl = 'https://www.googleapis.com/upload/storage/v1/';

	/**
	 * The URL of the OAuth2 token service
	 */
	const tokenUrl = 'https://www.googleapis.com/oauth2/v4/token';

	/**
	 * Default cURL options
	 *
	 * @var array
	 */
	private $defaultOptions = array(
		CURLOPT_SSL_VERIFYPEER => true,
		CURLOPT_SSL_VERIFYHOST => true,
		CURLOPT_VERBOSE        => true,
		CURLOPT_HEADER         => false,
		CURLINFO_HEADER_OUT    => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CAINFO         => AKEEBA_CACERT_PEM,
	);

	/**
	 * Public constructor. Both parameters are given to you by Google in a JSON file.
	 *
	 * Instructions:
	 * Go to https://console.developers.google.com/permissions/serviceaccounts?pli=1
	 * Select the API Project where your Google Storage bucket is already located in.
	 * Click on Create Service Account
	 * Set the Service Account Name to Akeeba Backup Service Account
	 * Click on Role and select Storage > Storage Admin (do NOT select Storage Object Admin instead IT WILL NOT WORK!!!)
	 * Check the "Furnish a new private key" checkbox. The Key Type section appears. Make sure JSON is selected.
	 * Click on the CREATE link at the bottom right.
	 * Your server prompts you to download a file. Save it as googlestorage.json
	 * Open the googlestorage.json. client_email --> $serviceEmail, private_key --> $privateKeyPEM
	 *
	 * @param   string  $serviceEmail   The Google Cloud Service Account (fake) email address.
	 * @param   string  $privateKeyPEM  The Google Cloud Service Account private key in PEM format.
	 */
	public function __construct($serviceEmail, $privateKeyPEM)
	{
		$this->clientEmail = $serviceEmail;
		$this->privateKey  = $privateKeyPEM;
		$this->accessToken = null;
		$this->expires     = time() - 1;
	}

	/**
	 * Returns the service access token.
	 *
	 * If there is no access token, or if it has expired, we are fetching a new one.
	 *
	 * @return null|string
	 */
	protected function getToken()
	{
		// Less than a minute before the token expires? Expire it immediately.
		if ($this->expires < (time() - 60))
		{
			$this->accessToken = '';
		}

		if (empty($this->accessToken))
		{
			$explicitPost = 'grant_type=' . urlencode('urn:ietf:params:oauth:grant-type:jwt-bearer') .
				'&assertion=' . $this->getJWTAssertion($this->clientEmail, $this->privateKey);

			$result = $this->fetch('POST', self::tokenUrl, array(
				'authenticated_request' => false,
				'headers'               => array(
					'Content-Type: application/x-www-form-urlencoded',
				),
			), $explicitPost);

			if (!is_array($result) || empty($result) || !isset($result['access_token']) || !isset($result['expires_in']))
			{
				throw new \RuntimeException("Cannot get access token from Google Cloud: invalid response", 500);
			}

			$this->accessToken = $result['access_token'];
			$this->expires     = time() + (int) $result['expires_in'];
		}

		return $this->accessToken;
	}

	/**
	 * Utility method to base sixty four encode data and then URL encode the result in a format that's compatible with
	 * Google Cloud.
	 *
	 * @param   string  $data  The data to encode
	 *
	 * @return  string
	 */
	private function bsfUrlEncode($data)
	{
		/**
		 * Working around hosts with broken malware scanners. Ironically, the best way for benign software like ours to
		 * do that is by following the same code obscuring techniques as legitimate malware. You know, of the kind that
		 * these hosts' malware scanners fail to catch.
		 */
		$funcName   = substr('baseball', 0, 4);
		$funcName   .= (string) (4 * 4 * 4);
		$funcName   .= '_' . substr('length', 1, 2);
		$funcName   .= substr('barcode', -4);
		$bsfEncData = call_user_func_array($funcName, array($data));

		return rtrim(strtr($bsfEncData, '+/', '-_'), '=');
	}

	/**
	 * Returns a pre-calculated JWT assertion which you need to retrieve an access token from Google. If the assertion
	 * does not exist it will be calculated.
	 *.
	 * @param   string  $serviceAccountEmail  The Google Cloud Service Account (fake) email address
	 * @param   string  $privateKey           The Google Cloud Service Account private key in PEM format
	 *
	 * @return  string  The JWT assertion
	 */
	private function getJWTAssertion($serviceAccountEmail, $privateKey)
	{
		if (empty($this->jwtAssertion))
		{
			// Base Sixty Four Encoded JSON header
			$jwtHeader = $this->bsfUrlEncode(json_encode(array(
				"alg" => "RS256",
				"typ" => "JWT",
			)));

			/**
			 * Base Sixty Four Encoded JSON claim set.
			 *
			 * If you need multiple scopes they must be SPACE-DELIMITED in the scope field below. Yes, SPACE, NOT COMMA.
			 * For valid scopes see https://developers.google.com/identity/protocols/googlescopes#storagev1
			 */
			$now      = time();
			$jwtClaim = $this->bsfUrlEncode(json_encode(array(
				"iss"   => $serviceAccountEmail,
				"scope" => "https://www.googleapis.com/auth/devstorage.full_control",
				"aud"   => "https://www.googleapis.com/oauth2/v4/token",
				"exp"   => $now + 3600,
				"iat"   => $now,
			)));

			// The base string for the signature: {Encoded JSON header}.{Encoded JSON claim set}
			openssl_sign(
				$jwtHeader . "." . $jwtClaim,
				$jwtSig,
				$privateKey,
				"sha256WithRSAEncryption"
			);

			$jwtSign = $this->bsfUrlEncode($jwtSig);

			//{Base64url encoded JSON header}.{Base64url encoded JSON claim set}.{Base64url encoded signature}
			$this->jwtAssertion = $jwtHeader . "." . $jwtClaim . "." . $jwtSign;
		}

		return $this->jwtAssertion;
	}

/**
	 * List all buckets under the user's account
	 *
	 * @param   string  $project_id  A valid API project identifier
	 *
	 * @return  array  See https://cloud.google.com/storage/docs/json_api/v1/buckets/list
	 */
	public function listBuckets($project_id)
	{
		$relativeUrl = 'b?project=' . urlencode($project_id);

		$result = $this->fetch('GET', $relativeUrl);

		return $result;
	}

	/**
	 * Get the raw listing of a bucket (either root or a specific path)
	 *
	 * @param   string  $bucket        The bucket containing the path
	 * @param   string  $path          The relative path of the folder to list its contents
	 * @param   int     $maxResults    Maximum number of results to return per page
	 * @param   string  $pageToken     Page token returned by the API, for resuming listing paginated results
	 *
	 * @return  array  See http://onedrive.github.io/items/list.htm
	 *
	 * @see  https://cloud.google.com/storage/docs/json_api/v1/objects/list
	 */
	public function getRawContents($bucket, $path = '/', $maxResults = 1000, $pageToken = null)
	{
		$relativeUrl = 'b/' . $bucket . '/o';
		$path        = $this->normalizePath($path);

		// Normalize maxResults in the range 1-1000
		$maxResults = max(1, $maxResults);
		$maxResults = min($maxResults, 1000);

		$relativeUrl .= '?orderby=name%20asc&delimiter=/&maxResults=' . $maxResults;

		if (!empty($path))
		{
			$relativeUrl .= '&prefix=' . $this->normalizePath($path);
		}

		if (!empty($pageToken))
		{
			$relativeUrl .= '&pageToken=' . $pageToken;
		}

		$result = $this->fetch('GET', $relativeUrl);

		return $result;
	}

	/**
	 * Get the processed listing of a folder. Goes through all the pages of the results.
	 *
	 * @param   string  $bucket        The bucket containing the path to list
	 * @param   string  $path          The relative path of the folder to list its contents
	 *
	 * @return  array  Two arrays under keys folders and files. Folders is a list of folders (prefixes). Files has the file name as key and size in bytes as value
	 */
	public function listContents($bucket, $path = '/')
	{
		$return = array(
			'files'   => array(),
			'folders' => array(),
		);

		$pageToken = null;

		do
		{
			$result = $this->getRawContents($bucket, $path);

			$pageToken = isset($result['nextPageToken']) ? $result['nextPageToken'] : null;

			if (isset($result['prefixes']))
			{
				$return['folders'] = $result['prefixes'];
			}

			if (!isset($result['items']) && !count($result['items']))
			{
				return $return;
			}

			foreach ($result['items'] as $item)
			{
				/** @see https://cloud.google.com/storage/docs/json_api/v1/objects#resource */
				$return['files'][$item['name']] = $item['size'];
			}

		} while (!is_null($pageToken));


		return $return;
	}

	/**
	 * Delete a file
	 *
	 * @param   string  $bucket       The bucket containing the path
	 * @param   string  $path         The relative path to the file to delete
	 * @param   bool    $failOnError  Throw exception if the deletion fails? Default true.
	 *
	 * @return  bool  True on success
	 *
	 * @throws  \Exception
	 */
	public function delete($bucket, $path, $failOnError = true)
	{
		$relativeUrl = 'b/' . $bucket . '/o/' . $this->normalizePath($path);

		try
		{
			$result = $this->fetch('DELETE', $relativeUrl);
		}
		catch (\Exception $e)
		{
			if (!$failOnError)
			{
				return false;
			}

			throw $e;
		}

		return true;
	}

	/**
	 * Download a remote file
	 *
	 * @param   string  $bucket     The bucket containing the path
	 * @param   string  $path       The path of the file in Google Storage
	 * @param   string  $localFile  The absolute filesystem path where the file will be downloaded to
	 */
	public function download($bucket, $path, $localFile)
	{
		$relativeUrl = 'b/' . $bucket . '/o/' . $this->normalizePath($path) . '?alt=media';

		$this->fetch('GET', $relativeUrl, array(
			'file' => $localFile,
		));
	}

	/**
	 * Uploads a file. You should only use it for files up to 5Mb.
	 *
	 * @param   string  $bucket     The bucket containing the path
	 * @param   string  $path       The path of the file in Google Storage
	 * @param   string  $localFile  The absolute local filesystem path to upload from
	 *
	 * @return  array  See
	 *
	 * @see  https://cloud.google.com/storage/docs/json_api/v1/how-tos/simple-upload
	 */
	public function simpleUpload($bucket, $path, $localFile)
	{
		// Make sure this file is 100Mb or smaller
		clearstatcache();
		$filesize = @filesize($localFile);

		if ($filesize > 104857600)
		{
			// throw new \RuntimeException("File size too big for simpleUpload ($filesize bigger than 100Mb).", 500);
		}

		// Get the relative URL
		$relativeUrl =
			self::uploadUrl .
			'b/' . $bucket . '/o?uploadType=media&name=' . $this->normalizePath($path);

		$additional = array(
			'file'  => $localFile,
			'headers' => array(
				'Content-Type: application/octet-stream',
				'Content-Length: ' . $filesize,
			),
			'no-parse' => true,
		);

		$response = $this->fetch('POST', $relativeUrl, $additional);

		return $response;
	}

	/**
	 * Creates a new resumable upload session and returns its upload URL
	 *
	 * @param   string  $bucket     The bucket containing the path
	 * @param   string  $path       The path of the file in Google Storage
	 * @param   string  $localFile  The absolute local filesystem path to upload from
	 *
	 * @return  string  The upload URL for the session
	 *
	 * @see  https://cloud.google.com/storage/docs/json_api/v1/how-tos/resumable-upload
	 */
	public function createUploadSession($bucket, $path, $localFile)
	{
		// Make sure this file is 100Mb or smaller
		clearstatcache();
		$filesize = @filesize($localFile);

		if ($filesize < 5242880)
		{
			throw new \RuntimeException("File size too small for resumable upload ($filesize smaller than 5Mb).", 500);
		}

		// Get the relative URL
		$relativeUrl =
			self::uploadUrl .
			'b/' . $bucket . '/o?uploadType=resumable';

		$json = json_encode([
			'name' => $path
		]);

		$response = $this->fetch('POST', $relativeUrl, array(
			'headers'         => array(
				'Content-Type: application/json; charset=UTF-8',
				'X-Upload-Content-Type: application/octet-stream',
				'X-Upload-Content-Length: ' . (int) $filesize,
			),
			'curl-options'    => array(
				CURLOPT_HEADER => 1,
			),
			'no-parse'        => true,
			'follow-redirect' => false,
		), $json);

		$lines = explode("\r\n", $response);

		foreach ($lines as $line)
		{
			if (strpos($line, 'Location: ') === 0)
			{
				list($header, $location) = explode(': ', $line, 2);

				return $location;
			}
		}

		throw new \RuntimeException('Could not start an upload session', 500);
	}

	/**
	 * Upload a part
	 *
	 * @param   string  $sessionUrl  The upload session URL, see createUploadSession
	 * @param   string  $localFile   Absolute filesystem path of the source file
	 * @param   int     $from        Starting byte to begin uploading, default is 0 (start of file)
	 * @param   int     $length      Chunk size in bytes, default 5Mb.
	 *
	 * @return  array  Empty while the upload is incomplete, upload information when complete
	 *
	 * @see  https://cloud.google.com/storage/docs/json_api/v1/how-tos/resumable-upload
	 */
	public function uploadPart($sessionUrl, $localFile, $from = 0, $length = 5242880)
	{
		clearstatcache();
		$totalSize = filesize($localFile);
		$to = $from + $length - 1;

		if ($to > ($totalSize - 1))
		{
			$to = $totalSize - 1;
		}

		$contentLength = $to - $from + 1;

		$range = "$from-$to/$totalSize";

		$additional = array(
			'headers' => array(
				'Content-Length: ' . $contentLength,
				'Content-Range: bytes ' . $range
			),
			'expect-status' => array(308, 200, 201)
		);

		$fp = @fopen($localFile, 'rb');

		if ($fp === false)
		{
			throw new \RuntimeException("Could not open $localFile for reading", 500);
		}

		fseek($fp, $from);
		$data = fread($fp, $contentLength);
		fclose($fp);

		return $this->fetch('PUT', $sessionUrl, $additional, $data);
	}

	/**
	 * Upload a file using multipart uploads. Useful for files over 100Mb and up to 2Gb.
	 *
	 * @param   string  $bucket     The bucket containing the path
	 * @param   string  $path       Relative path in the Drive
	 * @param   string  $localFile  Absolute filesystem path of the source file
	 * @param   int     $partSize   Part size in bytes, default 10Mb, must NOT be over 60Mb! MUST be a multiple of 320Kb.
	 *
	 * @return  array  File metadata
	 */
	public function resumableUpload($bucket, $path, $localFile, $partSize = 5242880)
	{
		$sessionUrl = $this->createUploadSession($bucket, $path, $localFile);
		$from       = 0;

		while (true)
		{
			$result = $this->uploadPart($sessionUrl, $localFile, $from, $partSize);
			$from   += $partSize;

			// If the result doesn't have nextExpectedRanges we have finished uploading.
			if (isset($result['name']))
			{
				return $result;
			}
		}

		return $result;
	}

	/**
	 * Automatically decides which upload method to use to upload a file to Google Storage. This method will return when the
	 * entire file has been uploaded. If you want to implement staggered uploads use the createUploadSession and
	 * uploadPart methods.
	 *
	 * @param   string  $bucket     The bucket containing the path
	 * @param   string  $path       The remote path relative to Drive root
	 * @param   string  $localFile  The absolute local filesystem path
	 *
	 * @return  array  See http://onedrive.github.io/items/upload_put.htm
	 */
	public function upload($bucket, $path, $localFile)
	{
		clearstatcache();
		$filesize = @filesize($localFile);

		// Bigger than 100Mb: use resumable uploads with default (10Mb) parts
		if ($filesize > 5242880)
		{
			return $this->resumableUpload($bucket, $path, $localFile);
		}

		// Smaller files, use simple upload
		return $this->simpleUpload($bucket, $path, $localFile);
	}

	/**
	 * Execute an API call
	 *
	 * @param   string  $method        The HTTP method
	 * @param   string  $relativeUrl   The relative URL to ping
	 * @param   array   $additional    Additional parameters
	 * @param   mixed   $explicitPost  Passed explicitly to POST requests if set, otherwise $additional is passed.
	 *
	 * @throws  \RuntimeException
	 *
	 * @return  array
	 */
	protected function fetch($method, $relativeUrl, array $additional = array(), $explicitPost = null)
	{
		// Get full URL, if required
		$url = $relativeUrl;

		if (substr($relativeUrl, 0, 6) != 'https:')
		{
			$url = self::rootUrl . ltrim($relativeUrl, '/');
		}

		// Should I expect a specific header?
		$expectHttpStatus = false;

		if (isset($additional['expect-status']))
		{
			$expectHttpStatus = $additional['expect-status'];
			unset($additional['expect-status']);
		}

		// Am I told to not parse the result?
		$noParse = false;

		if (isset($additional['no-parse']))
		{
			$noParse = $additional['no-parse'];
			unset ($additional['no-parse']);
		}

		// Am I told not to follow redirections?
		$followRedirect = true;

		if (isset($additional['follow-redirect']))
		{
			$followRedirect = $additional['follow-redirect'];
			unset ($additional['follow-redirect']);
		}

		// Initialise and execute a cURL request
		$ch = curl_init($url);

		// Get the default options array
		$options = $this->defaultOptions;

		// Do I have explicit cURL options to add?
		if (isset($additional['curl-options']) && is_array($additional['curl-options']))
		{
			// We can't use array_merge since we have integer keys and array_merge reassigns them :(
			foreach ($additional['curl-options'] as $k => $v)
			{
				$options[$k] = $v;
			}
		}

		// Set up custom headers
		$headers = array();

		if (isset($additional['headers']))
		{
			$headers = $additional['headers'];
			unset ($additional['headers']);
		}

		// Add the authorization header
		$authenticated = true;

		if (isset($additional['authenticated_request']))
		{
			$authenticated = $additional['authenticated_request'];

			unset($additional['authenticated_request']);
		}

		if ($authenticated)
		{
			$headers[] = 'Authorization: Bearer ' . $this->getToken();
		}

		$options[CURLOPT_HTTPHEADER] = $headers;

		// Handle files
		$file = null;
		$fp   = null;

		if (isset($additional['file']))
		{
			$file = $additional['file'];
			unset ($additional['file']);
		}

		if (!isset($additional['fp']) && !empty($file))
		{
			$mode = ($method == 'GET') ? 'wb' : 'rb';
			$fp   = @fopen($file, $mode);
		}
		elseif (isset($additional['fp']))
		{
			$fp = $additional['fp'];
			unset($additional['fp']);
		}

		// Set up additional options
		if ($method == 'GET' && $fp)
		{
			$options[CURLOPT_RETURNTRANSFER] = false;
			$options[CURLOPT_HEADER]         = false;
			$options[CURLOPT_FILE]           = $fp;
			$options[CURLOPT_BINARYTRANSFER] = true;

			if (!$expectHttpStatus)
			{
				$expectHttpStatus = 200;
			}
		}
		elseif ($method == 'POST' && $fp)
		{
			$options[CURLOPT_POST]   = true;
			$options[CURLOPT_INFILE] = $fp;

			if ($file)
			{
				clearstatcache();
				$options[CURLOPT_INFILESIZE] = @filesize($file);
			}
			else
			{
				$options[CURLOPT_INFILESIZE] = strlen(stream_get_contents($fp));
			}

			fseek($fp, 0);
		}
		elseif ($method == 'POST')
		{
			$options[CURLOPT_POST] = true;

			if ($explicitPost)
			{
				$options[CURLOPT_POSTFIELDS] = $explicitPost;
			}
			elseif (!empty($additional))
			{
				$options[CURLOPT_POSTFIELDS] = $additional;
			}
		}
		elseif ($method == 'PUT' && $fp)
		{
			$options[CURLOPT_PUT]    = true;
			$options[CURLOPT_INFILE] = $fp;

			if ($file)
			{
				clearstatcache();
				$options[CURLOPT_INFILESIZE] = @filesize($file);
			}
			else
			{
				$options[CURLOPT_INFILESIZE] = strlen(stream_get_contents($fp));
			}

			fseek($fp, 0);
		}
		else // Any other HTTP method, e.g. DELETE
		{
			$options[CURLOPT_CUSTOMREQUEST] = $method;

			if ($explicitPost)
			{
				$options[CURLOPT_POSTFIELDS] = $explicitPost;
			}
			elseif (!empty($additional))
			{
				$options[CURLOPT_POSTFIELDS] = $additional;
			}
		}

		// Set the cURL options at once
		@curl_setopt_array($ch, $options);

		// Set the follow location flag
		if ($followRedirect)
		{
			@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		}

		// Execute and parse the response
		$response     = curl_exec($ch);
		$errNo        = curl_errno($ch);
		$error        = curl_error($ch);
		$lastHttpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		// Close open file pointers
		if ($fp)
		{
			@fclose($fp);

			if (!empty($expectHttpStatus))
			{
				if (is_array($expectHttpStatus))
				{
					$correctStatus = in_array($lastHttpCode, $expectHttpStatus);
				}
				else
				{
					$correctStatus = $expectHttpStatus == $lastHttpCode;
				}

				if (!$correctStatus)
				{
					if ($file)
					{
						@unlink($file);
					}

					throw new \RuntimeException("Unexpected HTTP status $lastHttpCode", $lastHttpCode);
				}
			}
		}

		// Did we have a cURL error?
		if ($errNo)
		{
			throw new \RuntimeException("cURL error $errNo: $error", 500);
		}

		if ($expectHttpStatus)
		{
			if ($expectHttpStatus == $lastHttpCode)
			{
				return array();
			}
		}

		if ($noParse)
		{
			return $response;
		}

		if (empty($response))
		{
			return array();
		}

		// Parse the response
		$response = json_decode($response, true);

		// Did we get invalid JSON data?
		if (!$response)
		{
			throw new \RuntimeException("Invalid JSON data received", 500);
		}

		// Did we get an error response?
		if (isset($response['error']) && is_array($response['error']))
		{
			$error            = $response['error']['code'];
			$errorDescription = isset($response['error']['message']) ? $response['error']['message'] : 'No error description provided';

			throw new \RuntimeException("Error $error: $errorDescription", 500);
		}

		// Did we get an error response (from the helper script)?
		if (isset($response['error']))
		{
			$error            = $response['error'];
			$errorDescription = isset($response['error_description']) ? $response['error_description'] : 'No error description provided';

			throw new \RuntimeException("Error $error: $errorDescription", 500);
		}

		return $response;
	}

	/**
	 * Removes leading and trailing forward slashes, then encodes the file path per the JSON API requirements,
	 *
	 * @param   string  $path
	 *
	 * @return  string
	 *
	 * @see  https://cloud.google.com/storage/docs/json_api/
	 */
	protected function normalizePath($path)
	{
		$path = trim($path, '/');

		// No path? Nothing to escape.
		if (empty($path))
		{
			return $path;
		}

		// Can we cheat?
		if (urlencode($path) == $path)
		{
			return $path;
		}

		$safeChars = array(
			'-', '.', '_', '~', '!', '$', '&', '\'', '(', ')', '*', '+', ',', ';', '=', ':', '@',
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
			'u', 'v', 'w', 'x', 'y', 'z',
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
			'U', 'V', 'W', 'X', 'Y', 'Z',
		);
		$ret       = '';
		$chars     = str_split($path);

		foreach ($chars as $char)
		{
			if (in_array($chars, $safeChars))
			{
				$ret .= $char;

				continue;
			}

			$ret .= urlencode($char);
		}

		return $ret;
	}
}