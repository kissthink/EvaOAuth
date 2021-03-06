<?php
    
namespace EvaOAuth\Adapter\OAuth2;

use EvaOAuth\Adapter\OAuth2\AbstractAdapter;
use EvaOAuth\Service\Token\Access as AccessToken;

class Renren extends AbstractAdapter
{
    protected $authorizeUrl = "https://graph.renren.com/oauth/authorize";
    protected $accessTokenUrl = "https://graph.renren.com/oauth/token";

    public function accessTokenToArray(AccessToken $accessToken)
    {
        $token = parent::accessTokenToArray($accessToken);
        $user = $accessToken->getParam('user');
        if($user) {
            $user = (array) $user;
            $token['remoteUserId'] = $user['id'];
            $token['remoteUserName'] = $user['name'];
            $token['remoteExtra'] = \Zend\Json\Json::encode($user);
        }
        return $token;
    }
}
