<?php
/*
 * UnifonicNextGenLib
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace UnifonicNextGenLib\Controllers;

use UnifonicNextGenLib\APIException;
use UnifonicNextGenLib\APIHelper;
use UnifonicNextGenLib\Configuration;
use UnifonicNextGenLib\Models;
use UnifonicNextGenLib\Exceptions;
use UnifonicNextGenLib\Utils\DateTimeHelper;
use UnifonicNextGenLib\Http\HttpRequest;
use UnifonicNextGenLib\Http\HttpResponse;
use UnifonicNextGenLib\Http\HttpMethod;
use UnifonicNextGenLib\Http\HttpContext;
use UnifonicNextGenLib\Servers;
use Unirest\Request;

/**
 * @todo Add a general description for this controller.
 */
class RestController extends BaseController
{
    /**
     * @var RestController The reference to *Singleton* instance of this class
     */
    private static $instance;

    /**
     * Returns the *Singleton* instance of this class.
     * @return RestController The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        
        return static::$instance;
    }

    /**
     * Unifonic Stop scheduled messages API allows you to Delete (Stops) scheduled message,If MessageID is
     * specified only one message is stopped, Otherwise all messages are stopped through simple RESTful
     * APIs.
     *
     * @param string  $appSid         A character string that uniquely identifies your app
     * @param integer $messageID      (optional) A unique ID that identifies a message
     * @param string  $responseFormat (optional) support json format only
     * @param bool    $baseEncode     (optional) Binary-to-text encoding schemes that represent binary data in an ASCII
     *                                string format
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function deleteStopScheduledMessages(
        $appSid,
        $messageID = null,
        $responseFormat = null,
        $baseEncode = null
    ) {
        //check that all required arguments are provided
        if (!isset($appSid)) {
            throw new \InvalidArgumentException("One or more required arguments were NULL.");
        }


        //prepare query string for API call
        $_queryBuilder = '/rest/SMS/messages/scheduledmessages';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'AppSid'         => $appSid,
            'MessageID'      => $messageID,
            'responseFormat' => $responseFormat,
            'baseEncode'     => var_export($baseEncode, true),
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri(Servers::BASE_URL) . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Accept'        => 'application/json'
        );

        //set HTTP basic auth parameters
        Request::auth(Configuration::$basicAuthUserName, Configuration::$basicAuthPassword);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::DELETE, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::delete($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 401) {
            throw new APIException('Authentication failed', $_httpContext);
        }

        if ($response->code == 455) {
            throw new APIException('Scheduled message not found for this User', $_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        $mapper = $this->getJsonMapper();

        return $mapper->mapClass($response->body, 'UnifonicNextGenLib\\Models\\StopScheduledMessagesResponse');
    }

    /**
     * Unifonic Send Scheduled API allows you to schedule text messages to users around the globe through
     * simple RESTful API to be sent in future.
     *
     * @param string   $appSid        A character string that uniquely identifies your app
     * @param string   $senderID      The SenderID to send from, App default SenderID is used unless else stated
     * @param integer  $recipient     Destination mobile number, mobile numbers must be in international format without
     *                                00 or + Example: (4452023498)
     * @param string   $body          Message body supports both English and unicodes characters, concatenated messages
     *                                is supported
     * @param DateTime $timeScheduled Schedule send messages, in the following format yyyy-mm-dd HH:mm:ss
     * @param string   $responseType  (optional) Support json format only
     * @param string   $correlationID (optional) Is a unique identifier value that is attached to requests and
     *                                messages
     * @param bool     $baseEncode    (optional) Binary-to-text encoding schemes that represent binary data in an ASCII
     *                                string format
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function createSendScheduledMessages(
        $appSid,
        $senderID,
        $recipient,
        $body,
        $timeScheduled,
        $responseType = null,
        $correlationID = null,
        $baseEncode = null
    ) {
        //check that all required arguments are provided
        if (!isset($appSid, $senderID, $recipient, $body, $timeScheduled)) {
            throw new \InvalidArgumentException("One or more required arguments were NULL.");
        }


        //prepare query string for API call
        $_queryBuilder = '/rest/SMS/messages/scheduledmessages';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'AppSid'        => $appSid,
            'SenderID'      => $senderID,
            'Recipient'     => $recipient,
            'Body'          => $body,
            'TimeScheduled' => DateTimeHelper::toRfc1123DateTime($timeScheduled),
            'responseType'  => $responseType,
            'CorrelationID' => $correlationID,
            'baseEncode'    => var_export($baseEncode, true),
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri(Servers::BASE_URL) . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Accept'        => 'application/json'
        );

        //set HTTP basic auth parameters
        Request::auth(Configuration::$basicAuthUserName, Configuration::$basicAuthPassword);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 401) {
            throw new APIException('Authentication failed', $_httpContext);
        }

        if ($response->code == 406) {
            throw new APIException('Wrong parameter format', $_httpContext);
        }

        if ($response->code == 449) {
            throw new APIException('Message body is empty', $_httpContext);
        }

        if ($response->code == 451) {
            throw new APIException('TimeScheduled parameter must indicate time in the future', $_httpContext);
        }

        if ($response->code == 480) {
            throw new APIException('This user cannot use specified SenderID', $_httpContext);
        }

        if ($response->code == 482) {
            throw new APIException('Invalid dest num', $_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        $mapper = $this->getJsonMapper();

        return $mapper->mapClass($response->body, 'UnifonicNextGenLib\\Models\\SendScheduledmessagesResponse');
    }

    /**
     * Unifonic Get message details API allows you to get details of messages with optional filters,returns
     * paginated messages, next page or previous page through simple RESTful APIs
     *
     * @param string   $appSid        A character string that uniquely identifies your app
     * @param integer  $messageID     (optional) A unique ID that identifies a message
     * @param string   $senderID      (optional) The SenderID to send from, App default SenderID is used unless else
     *                                stated
     * @param integer  $recipient     (optional) Destination mobile number, mobile numbers must be in international
     *                                format without 00 or + Example: (4452023498)
     * @param DateTime $dateFrom      (optional) The start date for the report time interval, date format should be
     *                                yyyy-mm-dd
     * @param DateTime $dateTo        (optional) The end date for the report time interval, date format should be yyyy-
     *                                mm-dd
     * @param string   $correlationID (optional) Is a unique identifier value that is attached to requests and
     *                                messages
     * @param integer  $limit         (optional) The maximum number of messages details
     * @param bool     $baseEncode    (optional) Binary-to-text encoding schemes that represent binary data in an ASCII
     *                                string format
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function createGetMessageDetails(
        $appSid,
        $messageID = null,
        $senderID = null,
        $recipient = null,
        $dateFrom = null,
        $dateTo = null,
        $correlationID = null,
        $limit = null,
        $baseEncode = null
    ) {
        //check that all required arguments are provided
        if (!isset($appSid)) {
            throw new \InvalidArgumentException("One or more required arguments were NULL.");
        }


        //prepare query string for API call
        $_queryBuilder = '/rest/SMS/Messages/GetMessagesDetails';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'AppSid'        => $appSid,
            'MessageID'     => $messageID,
            'senderID'      => $senderID,
            'Recipient'     => $recipient,
            'dateFrom'      => DateTimeHelper::toSimpleDate($dateFrom),
            'dateTo'        => DateTimeHelper::toSimpleDate($dateTo),
            'CorrelationID' => $correlationID,
            'Limit'         => $limit,
            'baseEncode'    => var_export($baseEncode, true),
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri(Servers::BASE_URL) . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Accept'        => 'application/json'
        );

        //set HTTP basic auth parameters
        Request::auth(Configuration::$basicAuthUserName, Configuration::$basicAuthPassword);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 401) {
            throw new APIException('Authentication failed', $_httpContext);
        }

        if ($response->code == 432) {
            throw new APIException('MessageId must be numeric', $_httpContext);
        }

        if ($response->code == 599) {
            throw new APIException('Request failed', $_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        $mapper = $this->getJsonMapper();

        return $mapper->mapClass($response->body, 'UnifonicNextGenLib\\Models\\GetMessagesDetailsResponse');
    }

    /**
     * Unifonic Scheduled message details allows you to get details of scheduled messages through simple
     * RESTful APIs
     *
     * @param string $appSid A character string that uniquely identifies your app
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getScheduledMessageDetails(
        $appSid
    ) {
        //check that all required arguments are provided
        if (!isset($appSid)) {
            throw new \InvalidArgumentException("One or more required arguments were NULL.");
        }


        //prepare query string for API call
        $_queryBuilder = '/rest/SMS/messages/scheduledmessages';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'AppSid' => $appSid,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri(Servers::BASE_URL) . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Accept'        => 'application/json'
        );

        //set HTTP basic auth parameters
        Request::auth(Configuration::$basicAuthUserName, Configuration::$basicAuthPassword);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 401) {
            throw new APIException('Authentication failed', $_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        $mapper = $this->getJsonMapper();

        return $mapper->mapClass($response->body, 'UnifonicNextGenLib\\Models\\GetScheduledMessageResponse');
    }

    /**
     * Unifonic Send API allows you to send  text messages to users around the globe through simple RESTful
     * APIs
     *
     * @param string  $appSid         A character string that uniquely identifies your app
     * @param string  $senderID       The SenderID to send from, App default SenderID is used unless else stated
     * @param string  $body           Message body supports both English and unicodes characters, concatenated messages
     *                                is supported
     * @param integer $recipient      Destination mobile number, mobile numbers must be in international format without
     *                                00 or + Example: (4452023498)
     * @param string  $responseType   (optional) Support json format only
     * @param string  $correlationID  (optional) Is a unique identifier value that is attached to requests and
     *                                messages
     * @param bool    $baseEncode     (optional) Binary-to-text encoding schemes that represent binary data in an ASCII
     *                                string format
     * @param string  $statusCallback (optional) Filter messages report according to a specific message status, "Sent",
     *                                "Queued", "Rejected" or "Failed
     * @param bool    $async          (optional) It specifies that the request will be executed asynchronously as soon
     *                                as it is sent
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function createSendMessage(
        $appSid,
        $senderID,
        $body,
        $recipient,
        $responseType = null,
        $correlationID = null,
        $baseEncode = null,
        $statusCallback = null,
        $async = false
    ) {
        //check that all required arguments are provided
        if (!isset($appSid, $senderID, $body, $recipient)) {
            throw new \InvalidArgumentException("One or more required arguments were NULL.");
        }


        //prepare query string for API call
        $_queryBuilder = '/rest/SMS/messages';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'AppSid'         => $appSid,
            'SenderID'       => $senderID,
            'Body'           => $body,
            'Recipient'      => $recipient,
            'responseType'   => $responseType,
            'CorrelationID'  => $correlationID,
            'baseEncode'     => var_export($baseEncode, true),
            'statusCallback' => $statusCallback,
            'async'          => (null != $async) ? var_export($async, true) : false,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::getBaseUri(Servers::BASE_URL) . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Accept'        => 'application/json'
        );

        //set HTTP basic auth parameters
        Request::auth(Configuration::$basicAuthUserName, Configuration::$basicAuthPassword);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 401) {
            throw new APIException('Authentication failed', $_httpContext);
        }

        if ($response->code == 449) {
            throw new APIException('Message body is empty', $_httpContext);
        }

        if ($response->code == 480) {
            throw new APIException('This user cannot use specified SenderID', $_httpContext);
        }

        if ($response->code == 482) {
            throw new APIException('Invalid dest num', $_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        $mapper = $this->getJsonMapper();

        $decodedBody = json_decode($response->body);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Failed to decode JSON response: ' . json_last_error_msg());
        }

        return $mapper->mapClass($decodedBody, 'UnifonicNextGenLib\\Models\\SendResponse');
    }
}
