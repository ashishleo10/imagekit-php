<?php

namespace ImageKit\Manage;

use ImageKit\Constants\ErrorMessages;
use ImageKit\Resource\GuzzleHttpWrapper;
use ImageKit\Utils\Response;

class Cache
{

    /**
     * @param $urlParam
     * @param $resource
     * @return object
     */
    public function purgeFileCacheApi($urlParam, $resource)
    {
        if (empty($urlParam)) {
            return Response::respond(true, ((object)ErrorMessages::$CACHE_PURGE_URL_MISSING));
        }

        $urlParamArray = [
            'url' => $urlParam
        ];

        $resource->setDatas((array)$urlParamArray);
        $res = $resource->post();
        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && !(200 >= $res->getStatusCode() || $res->getStatusCode() <= 300)) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
    }

    /**
     * purgeCache File API
     *
     * @param $requestId
     * @param GuzzleHttpWrapper $resource
     * @return object
     */
    public function purgeFileCacheApiStatus($requestId, GuzzleHttpWrapper $resource)
    {
        if (empty($requestId)) {
            return Response::respond(true, ((object)ErrorMessages::$CACHE_PURGE_STATUS_ID_MISSING));
        }

        $res = $resource->get();

        $stream = $res->getBody();
        $content = $stream->getContents();

        if ($res->getStatusCode() && $res->getStatusCode() !== 200) {
            return Response::respond(true, json_decode($content));
        }

        return Response::respond(false, json_decode($content));
    }

}
