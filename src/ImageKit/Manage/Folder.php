<?php

namespace ImageKit\Manage;

use ImageKit\Constants\ErrorMessages;
use ImageKit\Resource\GuzzleHttpWrapper;
use ImageKit\Utils\Response;

/**
 *
 */
class Folder
{
    /**
     * @param $folderName
     * @param $parentFolderPath
     * @param GuzzleHttpWrapper $httpClient
     *
     * @return Response
     */
    public static function create($folderName, $parentFolderPath, GuzzleHttpWrapper $httpClient)
    {
        $httpClient->setDatas(['parentFolderPath' => $parentFolderPath, 'folderName' => $folderName]);
        $res = $httpClient->post();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        if($resource->getResponseMetadata()){
            $headers = $res->getHeaders();
            $content['headers'] = $headers;
        }

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }

    /**
     * @param $folderPath
     * @param GuzzleHttpWrapper $httpClient
     *
     * @return Response
     */
    public static function delete($folderPath, GuzzleHttpWrapper $httpClient)
    {
        if (empty($folderPath)) {
            return Response::respond(true, ((object)ErrorMessages::$MISSING_DELETE_FOLDER_OPTIONS));
        }

        $httpClient->setDatas(['folderPath' => $folderPath]);
        $res = $httpClient->delete();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        if($resource->getResponseMetadata()){
            $headers = $res->getHeaders();
            $content['headers'] = $headers;
        }

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }

    /**
     * @param $sourceFolderPath
     * @param $destinationPath
     * @param $includeVersions
     * @param GuzzleHttpWrapper $httpClient
     *
     * @return Response
     */
    public static function copy($sourceFolderPath, $destinationPath, $includeVersions, GuzzleHttpWrapper $httpClient)
    {
        $httpClient->setDatas(['sourceFolderPath' => $sourceFolderPath, 'destinationPath' => $destinationPath, 'includeVersions' => $includeVersions]);
        $res = $httpClient->post();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        if($resource->getResponseMetadata()){
            $headers = $res->getHeaders();
            $content['headers'] = $headers;
        }

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }

    /**
     * @param $sourceFolderPath
     * @param $destinationPath
     * @param GuzzleHttpWrapper $httpClient
     *
     * @return Response
     */
    public static function move($sourceFolderPath, $destinationPath, GuzzleHttpWrapper $httpClient)
    {
        $httpClient->setDatas(['sourceFolderPath' => $sourceFolderPath, 'destinationPath' => $destinationPath]);
        $res = $httpClient->post();
        $stream = $res->getBody();
        $content = [];
        $content['body'] = json_decode($stream->getContents());
        if($resource->getResponseMetadata()){
            $headers = $res->getHeaders();
            $content['headers'] = $headers;
        }

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, ($content));
        }

        return Response::respond(false, ($content));
    }
}
