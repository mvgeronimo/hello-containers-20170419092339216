<?php
/**
 * Copyright (c) 2016 Micorosft Corporation
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author James McQuillan <james.mcquillan@remote-learner.net>
 * @license MIT
 * @copyright (C) 2016 onwards Microsoft Corporation (http://microsoft.com/)
 */

namespace microsoft\adalphp\tests;

/**
 * Tests Client.
 *
 * @group adalphp
 * @codeCoverageIgnore
 */
class OIDCClientTest extends \PHPUnit_Framework_TestCase {
    /**
     * Test getting and setting credentials.
     */
    public function test_creds_getters_and_setters() {
        $httpclient = new \microsoft\adalphp\tests\MockHttpClient();
        $storage = new \microsoft\adalphp\tests\MockStorage();
        $client = new \microsoft\adalphp\OIDC\Client($httpclient, $storage);

        $this->assertNull($client->get_clientid());
        $this->assertNull($client->get_clientsecret());
        $this->assertNull($client->get_redirecturi());
        $this->assertNull($client->get_resource());

        $id = 'id';
        $secret = 'secret';
        $redirecturi = 'redirecturi';
        $resource = 'resource';
        $client->set_clientid($id);
        $client->set_clientsecret($secret);
        $client->set_redirecturi($redirecturi);
        $client->set_resource($resource);

        $this->assertEquals($id, $client->get_clientid());
        $this->assertEquals($secret, $client->get_clientsecret());
        $this->assertEquals($redirecturi, $client->get_redirecturi());
        $this->assertEquals($resource, $client->get_resource());
    }

    /**
     * Dataprovider returning endpoints.
     *
     * @return array Array of arrays of test parameters.
     */
    public function dataprovider_endpoints() {
        $tests = [];

        $tests['oneinvalid'] = [
            ['auth' => 100],
            ['\microsoft\adalphp\ADALPHPException', 'Invalid Endpoint URI received.']
        ];

        $tests['oneinvalidonevalid1'] = [
            ['auth' => 100, 'token' => 'http://example.com/token'],
            ['\microsoft\adalphp\ADALPHPException', 'Invalid Endpoint URI received.']
        ];

        $tests['oneinvalidonevalid2'] = [
            ['token' => 'http://example.com/token', 'auth' => 100],
            ['\microsoft\adalphp\ADALPHPException', 'Invalid Endpoint URI received.']
        ];

        $tests['onevalid'] = [
            ['token' => 'http://example.com/token'],
            []
        ];

        $tests['twovalid'] = [
            ['auth' => 'http://example.com/auth', 'token' => 'http://example.com/token'],
            []
        ];

        return $tests;
    }

    /**
     * Test setting and getting endpoints.
     *
     * @dataProvider dataprovider_endpoints
     */
    public function test_endpoints_getters_and_setters($endpoints, $expectedexception) {
        if (!empty($expectedexception)) {
            $this->setExpectedException($expectedexception[0], $expectedexception[1]);
        }
        $httpclient = new \microsoft\adalphp\tests\MockHttpClient();
        $storage = new \microsoft\adalphp\tests\MockStorage();
        $client = new \microsoft\adalphp\OIDC\Client($httpclient, $storage);

        if (isset($endpoints['auth'])) {
            $client->set_authendpoint($endpoints['auth']);
            $this->assertEquals($endpoints['auth'], $client->get_authendpoint());
        }
        if (isset($endpoints['token'])) {
            $client->set_tokenendpoint($endpoints['token']);
            $this->assertEquals($endpoints['token'], $client->get_tokenendpoint());
        }
    }
}
