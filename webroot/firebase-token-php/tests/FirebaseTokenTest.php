<?php

include_once "FirebaseToken.php";

class FirebaseTokenTest extends PHPUnit_Framework_TestCase {
  function testCreate() {
    $key = "0014ae3b1ded44de9d9f6fc60dfd1c64";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    $token = $tokenGen->createToken(array("foo" => "bar", "baz" => "boo", "uid" => "blah"));

    $data = JWT::decode($token, $key, array('HS256'));
    $this->assertEquals("bar", $data->d->foo);
    $this->assertEquals("boo", $data->d->baz);
    $this->assertInternalType("integer", $data->iat);
  }

  function testAdminDebug() {
    $key = "foobar";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    $token = $tokenGen->createToken(null, array("admin" => true, "debug" => true));

    $data = JWT::decode($token, $key, array('HS256'));
    $this->assertTrue($data->admin);
    $this->assertTrue($data->debug);
  }

  function testMalformedKeyThrowsException() {
    $this->setExpectedException("UnexpectedValueException", 'Invalid secret provided');
    $tokenGen = new Services_FirebaseTokenGenerator(1234567890);
  }

  function testExpires() {
    $key = "barfoo";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    $expires = time() + 1000;
    $token = $tokenGen->createToken(array("uid" => "blah"), array("expires" => $expires));

    $data = JWT::decode($token, $key, array('HS256'));
    $this->assertEquals($expires, $data->exp);
  }

  function testNotBeforeObject() {
    $key = "barfoo";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    $notBefore = new DateTime("now", new DateTimeZone('America/Los_Angeles'));
    $token = $tokenGen->createToken(array("uid" => "blah"), array("notBefore" => $notBefore));

    $data = JWT::decode($token, $key, array('HS256'));
    $this->assertEquals($notBefore->getTimestamp(), $data->nbf);
  }

  function testNoUID() {
    $key = "barfoo";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    $this->setExpectedException("Exception", 'Services_FirebaseTokenGenerator->createToken: data must contain a "uid" key that must be a string.');
    $token = $tokenGen->createToken(array("blah" => 5));
  }

  function testInvalidUID() {
    $key = "barfoo";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    $this->setExpectedException("Exception", 'Services_FirebaseTokenGenerator->createToken: data must contain a "uid" key that must be a string.');
    $token = $tokenGen->createToken(array("uid" => 5, "blah" => 5));
  }

  function testUIDMaxLength() {
    $key = "barfoo";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    //length:                                               10        20        30        40        50        60        70        80        90       100       110       120       130       140       150       160       170       180       190       200       210       220       230       240       250   256
    $token = $tokenGen->createToken(array("uid" => "1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456"));
  }

  function testUIDTooLong() {
    $key = "barfoo";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    $this->setExpectedException("Exception", 'Services_FirebaseTokenGenerator->createToken: data must contain a "uid" key that must not be longer than 256 bytes.');
    //length:                                               10        20        30        40        50        60        70        80        90       100       110       120       130       140       150       160       170       180       190       200       210       220       230       240       250    257
    $token = $tokenGen->createToken(array("uid" => "12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567"));
  }

  function testUIDMinLength() {
    $key = "barfoo";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    $token = $tokenGen->createToken(array("uid" => ""));
  }

  function testTokenTooLong() {
    $key = "barfoo";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    $this->setExpectedException("Exception", "Services_FirebaseTokenGenerator->createToken: generated token is too large.  Token cannot be larger than 1024 bytes.");
    $token = $tokenGen->createToken(array("uid" => "blah", "longVar" => "123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345612345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234561234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456"));
  }

  function testNoUIDWithAdmin() {
    $key = "barfoo";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    $token = $tokenGen->createToken(null, array("admin" => true));
    $token = $tokenGen->createToken(array(), array("admin" => true));
    $token = $tokenGen->createToken(array("foo" => "bar"), array("admin" => true));
  }

  function testInvalidUIDWithAdmin1() {
    $key = "barfoo";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    $this->setExpectedException("Exception", 'Services_FirebaseTokenGenerator->createToken: data must contain a "uid" key that must be a string.');
    $token = $tokenGen->createToken(array("uid" => 1), array("admin" => true));
  }

  function testInvalidUIDWithAdmin2() {
    $key = "barfoo";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    $this->setExpectedException("Exception", 'Services_FirebaseTokenGenerator->createToken: data must contain a "uid" key that must be a string.');
    $token = $tokenGen->createToken(array("uid" => null), array("admin" => true));
  }

  function testInvalidUIDWithAdmin3() {
    $key = "barfoo";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    $this->setExpectedException("Exception", "Services_FirebaseTokenGenerator->createToken: data must be null or an associative array of token data.");
    $token = $tokenGen->createToken("foo", array("admin" => true));
  }

  function testEmptyDataAndNoOptionsThrowsException() {
    $key = "barfoo";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    $this->setExpectedException("Exception", "Services_FirebaseTokenGenerator->createToken: data is empty and no options are set.  This token will have no effect on Firebase.");
    $tokenGen->createToken(null);
  }

  function testMalformedDataThrowsException() {
    $key = "barfoo";
    $tokenGen = new Services_FirebaseTokenGenerator($key);
    $this->setExpectedException("UnexpectedValueException", "Malformed UTF-8 characters, possibly incorrectly encoded");
    $tokenGen->createToken("\xB1\x31");
  }
}

?>
