<?php

use OCLC\Auth\WSKey;
use OCLC\Auth\AccessToken;
use GuzzleHttp\Psr7\Response;

class BibErrorTest extends \PHPUnit_Framework_TestCase {

    function setUp()
    {
        $options = array(
            'authenticatingInstitutionId' => 128807,
            'contextInstitutionId' => 128807,
            'scope' => array('WorldCatMetadataAPI')
        );
        $this->mockAccessToken = $this->getMockBuilder(AccessToken::class)
            ->setConstructorArgs(array('client_credentials', $options))
            ->getMock();

        $this->mockAccessToken->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue('tk_12345'));
    }

    function testCreateBibError(){
        $error = new BibError();
        $this->assertInstanceOf('BibError', $error);
        return $error;
    }

    /**
     * Set Request Error
     * @depends testCreateBibError
     */
    function testSetRequestError($error){
        $request_error = new Response(401, [], '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><error><code type="http">401</code><message>AccessToken {tk_12345} is invalid</message><detail>Authorization header: Bearer tk_12345</detail></error>');
        $error->setRequestError($request_error);
        $this->assertAttributeInstanceOf("GuzzleHttp\Psr7\Response", 'requestError', $error);
        return $error;
    }

    /**
     * Get Request Error
     * @depends testSetRequestError
     */
    function testGetRequestError($error){
        $this->assertInstanceOf("GuzzleHttp\Psr7\Response", $error->getRequestError());
        return $error;
    }

    /**
     * Get Code
     * @depends testGetRequestError
     */
    function testGetCode($error) {
        $this->assertEquals('401', $error->getCode());
    }

    /**
     * Get Message
     * @depends testGetRequestError
     */
    function testGetMessage($error) {
        $this->assertEquals('AccessToken {tk_12345} is invalid', $error->getMessage());
    }

    /**
     * Get Detail
     * @depends testGetRequestError
     */
    function testGetDetail($error) {
        $this->assertEquals('Authorization header: Bearer tk_12345', $error->getDetail());
    }

    /**
     * @vcr failureInvalidAccessToken
     * Invalid Access Token
     */
    function testErrorInvalidAccessToken(){
        $error = Bib::find(70775700, $this->mockAccessToken);
        $this->assertInstanceOf('BibError', $error);
        $this->assertEquals('401', $error->getCode());
        $this->assertEquals('AccessToken {tk_12345} is invalid', $error->getMessage());
        $this->assertEquals('Authorization header: Bearer tk_12345', $error->getDetail());
    }



}