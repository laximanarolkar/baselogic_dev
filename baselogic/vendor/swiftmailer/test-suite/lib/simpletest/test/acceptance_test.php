<?php
// $Id: acceptance_test.php 1808 2008-09-11 19:18:02Z pp11 $
require_once(dirname(__FILE__) . '/../autorun.php');
require_once(dirname(__FILE__) . '/../compatibility.php');
require_once(dirname(__FILE__) . '/../browser.php');
require_once(dirname(__FILE__) . '/../web_tester.php');
require_once(dirname(__FILE__) . '/../unit_tester.php');

class SimpleTestAcceptanceTest extends WebTestCase {
    static function samples() {
        return 'http://www.lastcraft.com/test/';
    }
}

class TestOfLiveBrowser extends UnitTestCase {
    function samples() {
        return SimpleTestAcceptanceTest::samples();
    }

    function testGet() {
        $browser = new SimpleBrowser();
        $browser->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
        $this->assertTrue($browser->get($this->samples() . 'network_confirm.php'));
        $this->assertPattern('/target for the SimpleTest/', $browser->getContent());
        $this->assertPattern('/Request method.*?<dd>GET<\/dd>/', $browser->getContent());
        $this->assertEqual($browser->getTitle(), 'Simple test target file');
        $this->assertEqual($browser->getResponseCode(), 200);
        $this->assertEqual($browser->getMimeType(), 'text/html');
    }
    
    function testPost() {
        $browser = new SimpleBrowser();
        $browser->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
        $this->assertTrue($browser->post($this->samples() . 'network_confirm.php'));
        $this->assertPattern('/target for the SimpleTest/', $browser->getContent());
        $this->assertPattern('/Request method.*?<dd>POST<\/dd>/', $browser->getContent());
    }
    
    function testAbsoluteLinkFollowing() {
        $browser = new SimpleBrowser();
        $browser->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
        $browser->get($this->samples() . 'link_confirm.php');
        $this->assertTrue($browser->clickLink('Absolute'));
        $this->assertPattern('/target for the SimpleTest/', $browser->getContent());
    }
    
    function testRelativeEncodedeLinkFollowing() {
        $browser = new SimpleBrowser();
        $browser->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
        $browser->get($this->samples() . 'link_confirm.php');
        $this->assertTrue($browser->clickLink("m�rc�l kiek'eboe"));
        $this->assertPattern('/target for the SimpleTest/', $browser->getContent());
    }
    
    function testRelativeLinkFollowing() {
        $browser = new SimpleBrowser();
        $browser->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
        $browser->get($this->samples() . 'link_confirm.php');
        $this->assertTrue($browser->clickLink('Relative'));
        $this->assertPattern('/target for the SimpleTest/', $browser->getContent());
    }
    
    function testUnifiedClickLinkClicking() {
        $browser = new SimpleBrowser();
        $browser->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
        $browser->get($this->samples() . 'link_confirm.php');
        $this->assertTrue($browser->click('Relative'));
        $this->assertPattern('/target for the SimpleTest/', $browser->getContent());
    }
    
    function testIdLinkFollowing() {
        $browser = new SimpleBrowser();
        $browser->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
        $browser->get($this->samples() . 'link_confirm.php');
        $this->assertTrue($browser->clickLinkById(1));
        $this->assertPattern('/target for the SimpleTest/', $browser->getContent());
    }
    
    function testCookieReading() {
        $browser = new SimpleBrowser();
        $browser->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
        $browser->get($this->samples() . 'set_cookies.php');
        $this->assertEqual($browser->getCurrentCookieValue('session_cookie'), 'A');
        $this->assertEqual($browser->getCurrentCookieValue('short_cookie'), 'B');
        $this->assertEqual($browser->getCurrentCookieValue('day_cookie'), 'C');
    }
    
    function testSimpleSubmit() {
        $browser = new SimpleBrowser();
        $browser->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
        $browser->get($this->samples() . 'form.html');
        $this->assertTrue($browser->clickSubmit('Go!'));
        $this->assertPattern('/Request method.*?<dd>POST<\/dd>/', $browser->getContent());
        $this->assertPattern('/go=\[Go!\]/', $browser->getContent());
    }
    
    function testUnifiedClickCanSubmit() {
        $browser = new SimpleBrowser();
        $browser->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
        $browser->get($this->samples() . 'form.html');
        $this->assertTrue($browser->click('Go!'));
        $this->assertPattern('/go=\[Go!\]/', $browser->getContent());
    }
}

class TestOfLocalFileBrowser extends UnitTestCase {
    function samples() {
        return 'file://'.dirname(__FILE__).'/site/';
    }

    function testGet() {
        $browser = new SimpleBrowser();
        $browser->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
        $this->assertTrue($browser->get($this->samples() . 'file.html'));
        $this->assertPattern('/Link to SimpleTest/', $browser->getContent());
        $this->assertEqual($browser->getTitle(), 'Link to SimpleTest');
        $this->assertFalse($browser->getResponseCode());
        $this->assertEqual($browser->getMimeType(), '');
    }
}

class TestRadioFields extends SimpleTestAcceptanceTest {
	function testSetFieldAsInteger() {
		$this->get($this->samples() . 'form_with_radio_buttons.html');
		$this->assertTrue($this->setField('tested_field', 2));
		$this->clickSubmitByName('send');
		$this->assertEqual($this->getUrl(), $this->samples() . 'form_with_radio_buttons.html?tested_field=2&send=click+me');
	}

	function testSetFieldAsString() {
		$this->get($this->samples() . 'form_with_radio_buttons.html');
		$this->assertTrue($this->setField('tested_field', '2'));
		$this->clickSubmitByName('send');
		$this->assertEqual($this->getUrl(), $this->samples() . 'form_with_radio_buttons.html?tested_field=2&send=click+me');
	}
}

class TestOfLiveFetching extends SimpleTestAcceptanceTest {
    function setUp() {
        $this->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
    }
 
	function testFormWithArrayBasedInputs() {
		$this->get($this->samples() . 'form_with_array_based_inputs.php');
		$this->setField('value[]', '3', '1');
		$this->setField('value[]', '4', '2');
		$this->clickSubmit('Go');
        $this->assertPattern('/QUERY_STRING : value%5B%5D=3&value%5B%5D=4&submit=Go/');
	}

	function testFormWithQuotedValues() {
		$this->get($this->samples() . 'form_with_quoted_values.php');
		$this->assertField('a', 'default');
		$this->assertFieldById('text_field', 'default');
		$this->clickSubmit('Go');
        $this->assertPattern('/a=default&submit=Go/');
	}

    function testGet() {
        $this->assertTrue($this->get($this->samples() . 'network_confirm.php'));
        $this->assertEqual($this->getUrl(), $this->samples() . 'network_confirm.php');
        $this->assertText('target for the SimpleTest');
        $this->assertPattern('/Request method.*?<dd>GET<\/dd>/');
        $this->assertTitle('Simple test target file');
        $this->assertTitle(new PatternExpectation('/target file/'));
        $this->assertResponse(200);
        $this->assertMime('text/html');
        $this->assertHeader('connection', 'close');
        $this->assertHeader('connection', new PatternExpectation('/los/'));
    }
    
    function testSlowGet() {
        $this->assertTrue($this->get($this->samples() . 'slow_page.php'));
    }
    
    function testTimedOutGet() {
        $this->setConnectionTimeout(1);
        $this->ignoreErrors();
        $this->assertFalse($this->get($this->samples() . 'slow_page.php'));
    }
    
    function testPost() {
        $this->assertTrue($this->post($this->samples() . 'network_confirm.php'));
        $this->assertText('target for the SimpleTest');
        $this->assertPattern('/Request method.*?<dd>POST<\/dd>/');
    }
    
    function testGetWithData() {
        $this->get($this->samples() . 'network_confirm.php', array("a" => "aaa"));
        $this->assertPattern('/Request method.*?<dd>GET<\/dd>/');
        $this->assertText('a=[aaa]');
    }
    
    function testPostWithData() {
        $this->post($this->samples() . 'network_confirm.php', array("a" => "aaa"));
        $this->assertPattern('/Request method.*?<dd>POST<\/dd>/');
        $this->assertText('a=[aaa]');
    }

    function testPostWithRecursiveData() {
        $this->post($this->samples() . 'network_confirm.php', array("a" => "aaa"));
        $this->assertPattern('/Request method.*?<dd>POST<\/dd>/');
        $this->assertText('a=[aaa]');

        $this->post($this->samples() . 'network_confirm.php', array("a[aa]" => "aaa"));
        $this->assertPattern('/Request method.*?<dd>POST<\/dd>/');
        $this->assertText('a=[aa=[aaa]]');

        $this->post($this->samples() . 'network_confirm.php', array("a[aa][aaa]" => "aaaa"));
        $this->assertPattern('/Request method.*?<dd>POST<\/dd>/');
        $this->assertText('a=[aa=[aaa=[aaaa]]]');

        $this->post($this->samples() . 'network_confirm.php', array("a" => array("aa" => "aaa")));
        $this->assertPattern('/Request method.*?<dd>POST<\/dd>/');
        $this->assertText('a=[aa=[aaa]]');

        $this->post($this->samples() . 'network_confirm.php', array("a" => array("aa" => array("aaa" => "aaaa"))));
        $this->assertPattern('/Request method.*?<dd>POST<\/dd>/');
        $this->assertText('a=[aa=[aaa=[aaaa]]]');
    }

    function testRelativeGet() {
        $this->get($this->samples() . 'link_confirm.php');
        $this->assertTrue($this->get('network_confirm.php'));
        $this->assertText('target for the SimpleTest');
    }
    
    function testRelativePost() {
        $this->post($this->samples() . 'link_confirm.php');
        $this->assertTrue($this->post('network_confirm.php'));
        $this->assertText('target for the SimpleTest');
    }
}

class TestOfLinkFollowing extends SimpleTestAcceptanceTest {
    function setUp() {
        $this->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
    }
    
    function testLinkAssertions() {
        $this->get($this->samples() . 'link_confirm.php');
        $this->assertLink('Absolute', $this->samples() . 'network_confirm.php');
        $this->assertLink('Absolute', new PatternExpectation('/confirm/'));
        $this->assertClickable('Absolute');
    }
    
    function testAbsoluteLinkFollowing() {
        $this->get($this->samples() . 'link_confirm.php');
        $this->assertTrue($this->clickLink('Absolute'));
        $this->assertText('target for the SimpleTest');
    }
    
    function testRelativeLinkFollowing() {
        $this->get($this->samples() . 'link_confirm.php');
        $this->assertTrue($this->clickLink('Relative'));
        $this->assertText('target for the SimpleTest');
    }
    
    function testLinkIdFollowing() {
        $this->get($this->samples() . 'link_confirm.php');
        $this->assertLinkById(1);
        $this->assertTrue($this->clickLinkById(1));
        $this->assertText('target for the SimpleTest');
    }
    
    function testAbsoluteUrlBehavesAbsolutely() {
        $this->get($this->samples() . 'link_confirm.php');
        $this->get('http://www.lastcraft.com');
        $this->assertText('No guarantee of quality is given or even intended');
    }
    
    function testRelativeUrlRespectsBaseTag() {
        $this->get($this->samples() . 'base_tag/base_link.html');
        $this->click('Back to test pages');
        $this->assertTitle('Simple test target file');
    }
}

class TestOfLivePageLinkingWithMinimalLinks extends SimpleTestAcceptanceTest {
    function setUp() {
        $this->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
    }
    
    function testClickToExplicitelyNamedSelfReturns() {
        $this->get($this->samples() . 'front_controller_style/a_page.php');
        $this->assertEqual($this->getUrl(), $this->samples() . 'front_controller_style/a_page.php');
        $this->assertTitle('Simple test page with links');
        $this->assertLink('Self');
        $this->clickLink('Self');
        $this->assertTitle('Simple test page with links');
    }
    
    function testClickToMissingPageReturnsToSamePage() {
        $this->get($this->samples() . 'front_controller_style/a_page.php');
        $this->clickLink('No page');
        $this->assertTitle('Simple test page with links');
        $this->assertText('[action=no_page]');
    }
    
    function testClickToBareActionReturnsToSamePage() {
        $this->get($this->samples() . 'front_controller_style/a_page.php');
        $this->clickLink('Bare action');
        $this->assertTitle('Simple test page with links');
        $this->assertText('[action=]');
    }
    
    function testClickToSingleQuestionMarkReturnsToSamePage() {
        $this->get($this->samples() . 'front_controller_style/a_page.php');
        $this->clickLink('Empty query');
        $this->assertTitle('Simple test page with links');
    }
    
    function testClickToEmptyStringReturnsToSamePage() {
        $this->get($this->samples() . 'front_controller_style/a_page.php');
        $this->clickLink('Empty link');
        $this->assertTitle('Simple test page with links');
    }
    
    function testClickToSingleDotGoesToCurrentDirectory() {
        $this->get($this->samples() . 'front_controller_style/a_page.php');
        $this->clickLink('Current directory');
        $this->assertTitle(
                'Simple test front controller',
                '%s -> index.php needs to be set as a default web server home page');
    }
    
    function testClickBackADirectoryLevel() {
        $this->get($this->samples() . 'front_controller_style/');
        $this->clickLink('Down one');
        $this->assertPattern('|Index of .*?/test|i');
    }
}

class TestOfLiveFrontControllerEmulation extends SimpleTestAcceptanceTest {
    function setUp() {
        $this->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
    }
    
    function testJumpToNamedPage() {
        $this->get($this->samples() . 'front_controller_style/');
        $this->assertText('Simple test front controller');
        $this->clickLink('Index');
        $this->assertResponse(200);
        $this->assertText('[action=index]');
    }
    
    function testJumpToUnnamedPage() {
        $this->get($this->samples() . 'front_controller_style/');
        $this->clickLink('No page');
        $this->assertResponse(200);
        $this->assertText('Simple test front controller');
        $this->assertText('[action=no_page]');
    }
    
    function testJumpToUnnamedPageWithBareParameter() {
        $this->get($this->samples() . 'front_controller_style/');
        $this->clickLink('Bare action');
        $this->assertResponse(200);
        $this->assertText('Simple test front controller');
        $this->assertText('[action=]');
    }
    
    function testJumpToUnnamedPageWithEmptyQuery() {
        $this->get($this->samples() . 'front_controller_style/');
        $this->clickLink('Empty query');
        $this->assertResponse(200);
        $this->assertPattern('/Simple test front controller/');
        $this->assertPattern('/raw get data.*?\[\].*?get data/si');
    }
    
    function testJumpToUnnamedPageWithEmptyLink() {
        $this->get($this->samples() . 'front_controller_style/');
        $this->clickLink('Empty link');
        $this->assertResponse(200);
        $this->assertPattern('/Simple test front controller/');
        $this->assertPattern('/raw get data.*?\[\].*?get data/si');
    }
    
    function testJumpBackADirectoryLevel() {
        $this->get($this->samples() . 'front_controller_style/');
        $this->clickLink('Down one');
        $this->assertPattern('|Index of .*?/test|');
    }
    
    function testSubmitToNamedPage() {
        $this->get($this->samples() . 'front_controller_style/');
        $this->assertText('Simple test front controller');
        $this->clickSubmit('Index');
        $this->assertResponse(200);
        $this->assertText('[action=Index]');
    }
    
    function testSubmitToSameDirectory() {
        $this->get($this->samples() . 'front_controller_style/index.php');
        $this->clickSubmit('Same directory');
        $this->assertResponse(200);
        $this->assertText('[action=Same+directory]');
    }
    
    function testSubmitToEmptyAction() {
        $this->get($this->samples() . 'front_controller_style/index.php');
        $this->clickSubmit('Empty action');
        $this->assertResponse(200);
        $this->assertText('[action=Empty+action]');
    }
    
    function testSubmitToNoAction() {
        $this->get($this->samples() . 'front_controller_style/index.php');
        $this->clickSubmit('No action');
        $this->assertResponse(200);
        $this->assertText('[action=No+action]');
    }
    
    function testSubmitBackADirectoryLevel() {
        $this->get($this->samples() . 'front_controller_style/');
        $this->clickSubmit('Down one');
        $this->assertPattern('|Index of .*?/test|');
    }
    
    function testSubmitToNamedPageWithMixedPostAndGet() {
        $this->get($this->samples() . 'front_controller_style/?a=A');
        $this->assertText('Simple test front controller');
        $this->clickSubmit('Index post');
        $this->assertText('action=[Index post]');
        $this->assertNoText('[a=A]');
    }
    
    function testSubmitToSameDirectoryMixedPostAndGet() {
        $this->get($this->samples() . 'front_controller_style/index.php?a=A');
        $this->clickSubmit('Same directory post');
        $this->assertText('action=[Same directory post]');
        $this->assertNoText('[a=A]');
    }
    
    function testSubmitToEmptyActionMixedPostAndGet() {
        $this->get($this->samples() . 'front_controller_style/index.php?a=A');
        $this->clickSubmit('Empty action post');
        $this->assertText('action=[Empty action post]');
        $this->assertText('[a=A]');
    }
    
    function testSubmitToNoActionMixedPostAndGet() {
        $this->get($this->samples() . 'front_controller_style/index.php?a=A');
        $this->clickSubmit('No action post');
        $this->assertText('action=[No action post]');
        $this->assertText('[a=A]');
    }
}

class TestOfLiveHeaders extends SimpleTestAcceptanceTest {
    function setUp() {
        $this->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
    }
    
    function testConfirmingHeaderExistence() {
        $this->get('http://www.lastcraft.com/');
        $this->assertHeader('content-type');
        $this->assertHeader('content-type', 'text/html');
        $this->assertHeader('content-type', new PatternExpectation('/HTML/i'));
        $this->assertNoHeader('WWW-Authenticate');
    }
}
 
class TestOfLiveRedirects extends SimpleTestAcceptanceTest {
    function setUp() {
        $this->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
    }
    
    function testNoRedirects() {
        $this->setMaximumRedirects(0);
        $this->get($this->samples() . 'redirect.php');
        $this->assertTitle('Redirection test');
    }
    
    function testRedirects() {
        $this->setMaximumRedirects(1);
        $this->get($this->samples() . 'redirect.php');
        $this->assertTitle('Simple test target file');
    }
    
    function testRedirectLosesGetData() {
        $this->get($this->samples() . 'redirect.php', array('a' => 'aaa'));
        $this->assertNoText('a=[aaa]');
    }
    
    function testRedirectKeepsExtraRequestDataOfItsOwn() {
        $this->get($this->samples() . 'redirect.php');
        $this->assertText('r=[rrr]');
    }
    
    function testRedirectLosesPostData() {
        $this->post($this->samples() . 'redirect.php', array('a' => 'aaa'));
        $this->assertTitle('Simple test target file');
        $this->assertNoText('a=[aaa]');
    }
    
    function testRedirectWithBaseUrlChange() {
        $this->get($this->samples() . 'base_change_redirect.php');
        $this->assertTitle('Simple test target file in folder');
        $this->get($this->samples() . 'path/base_change_redirect.php');
        $this->assertTitle('Simple test target file');
    }
    
    function testRedirectWithDoubleBaseUrlChange() {
        $this->get($this->samples() . 'double_base_change_redirect.php');
        $this->assertTitle('Simple test target file');
    }
}

class TestOfLiveCookies extends SimpleTestAcceptanceTest {
    function setUp() {
        $this->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
    }
    
    function here() {
        return new SimpleUrl($this->samples());
    }
    
    function thisHost() {
        $here = $this->here();
        return $here->getHost();
    }
    
    function thisPath() {
        $here = $this->here();
        return $here->getPath();
    }
    
    function testCookieSettingAndAssertions() {
        $this->setCookie('a', 'Test cookie a');
        $this->setCookie('b', 'Test cookie b', $this->thisHost());
        $this->setCookie('c', 'Test cookie c', $this->thisHost(), $this->thisPath());
        $this->get($this->samples() . 'network_confirm.php');
        $this->assertText('Test cookie a');
        $this->assertText('Test cookie b');
        $this->assertText('Test cookie c');
        $this->assertCookie('a');
        $this->assertCookie('b', 'Test cookie b');
        $this->assertTrue($this->getCookie('c') == 'Test cookie c');
    }
    
    function testNoCookieSetWhenCookiesDisabled() {
        $this->setCookie('a', 'Test cookie a');
        $this->ignoreCookies();
        $this->get($this->samples() . 'network_confirm.php');
        $this->assertNoText('Test cookie a');
    }
    
    function testCookieReading() {
        $this->get($this->samples() . 'set_cookies.php');
        $this->assertCookie('session_cookie', 'A');
        $this->assertCookie('short_cookie', 'B');
        $this->assertCookie('day_cookie', 'C');
    }
     
    function testNoCookie() {
        $this->assertNoCookie('aRandomCookie');
    }

    function testNoCookieReadingWhenCookiesDisabled() {
        $this->ignoreCookies();
        $this->get($this->samples() . 'set_cookies.php');
        $this->assertNoCookie('session_cookie');
        $this->assertNoCookie('short_cookie');
        $this->assertNoCookie('day_cookie');
    }
   
    function testCookiePatternAssertions() {
        $this->get($this->samples() . 'set_cookies.php');
        $this->assertCookie('session_cookie', new PatternExpectation('/a/i'));
    }
    
    function testTemporaryCookieExpiry() {
        $this->get($this->samples() . 'set_cookies.php');
        $this->restart();
        $this->assertNoCookie('session_cookie');
        $this->assertCookie('day_cookie', 'C');
    }
    
    function testTimedCookieExpiryWith100SecondMargin() {
        $this->get($this->samples() . 'set_cookies.php');
        $this->ageCookies(3600);
        $this->restart(time() + 100);
        $this->assertNoCookie('session_cookie');
        $this->assertNoCookie('hour_cookie');
        $this->assertCookie('day_cookie', 'C');
    }
    
    function testNoClockOverDriftBy100Seconds() {
        $this->get($this->samples() . 'set_cookies.php');
        $this->restart(time() + 200);
        $this->assertNoCookie(
                'short_cookie',
                '%s -> Please check your computer clock setting if you are not using NTP');
    }
    
    function testNoClockUnderDriftBy100Seconds() {
        $this->get($this->samples() . 'set_cookies.php');
        $this->restart(time() + 0);
        $this->assertCookie(
                'short_cookie',
                'B',
                '%s -> Please check your computer clock setting if you are not using NTP');
    }
    
    function testCookiePath() {
        $this->get($this->samples() . 'set_cookies.php');
        $this->assertNoCookie('path_cookie', 'D');
        $this->get('./path/show_cookies.php');
        $this->assertPattern('/path_cookie/');
        $this->assertCookie('path_cookie', 'D');
    }
}

class LiveTestOfForms extends SimpleTestAcceptanceTest {
    function setUp() {
        $this->addHeader('User-Agent: SimpleTest ' . SimpleTest::getVersion());
    }
    
    function testSimpleSubmit() {
        $this->get($this->samples() . 'form.html');
        $this->assertTrue($this->clickSubmit('Go!'));
        $this->assertPattern('/Request method.*?<dd>POST<\/dd>/');
        $this->assertText('go=[Go!]');
    }
    
    function testDefaultFormValues() {
        $this->get($this->samples() . 'form.html');
        $this->assertFieldByName('a', '');
        $this->assertFieldByName('b', 'Default text');
        $this->assertFieldByName('c', '');
        $this->assertFieldByName('d', 'd1');
        $this->assertFieldByName('e', false);
        $this->assertFieldByName('f', 'on');
        $this->assertFieldByName('g', 'g3');
        $this->assertFieldByName('h', 2);
        $this->assertFieldByName('go', 'Go!');
        $this->assertClickable('Go!');
        $this->assertSubmit('Go!');
        $this->assertTrue($this->clickSubmit('Go!'));
        $this->assertText('go=[Go!]');
        $this->assertText('a=[]');
        $this->assertText('b=[Default text]');
        $this->assertText('c=[]');
        $this->assertText('d=[d1]');
        $this->assertNoText('e=[');
        $this->assertText('f=[on]');
        $this->assertText('g=[g3]');
    }
    
    function testFormSubmissionByButtonLabel() {
        $this->get($this->samples() . 'form.html');
        $this->setFieldByName('a', 'aaa');
        $this->setFieldByName('b', 'bbb');
        $this->setFieldByName('c', 'ccc');
        $this->setFieldByName('d', 'D2');
        $this->setFieldByName('e', 'on');
        $this->setFieldByName('f', false);
        $this->setFieldByName('g', 'g2');
        $this->setFieldByName('h', 1);
        $this->assertTrue($this->clickSubmit('Go!'));
        $this->assertText('a=[aaa]');
        $this->assertText('b=[bbb]');
        $this->assertText('c=[ccc]');
        $this->assertText('d=[d2]');
        $this->assertText('e=[on]');
        $this->assertNoText('f=[');
        $this->assertText('g=[g2]');
    }
    
    function testAdditionalFormValues() {
        $this->get($this->samples() . 'form.html');
        $this->assertTrue($this->clickSubmit('Go!', array('add' => 'A')));
        $this->assertText('go=[Go!]');
        $this->assertText('add=[A]');
    }
    
    function testFormSubmissionByName() {
        $this->get($this->samples() . 'form.html');
        $this->setFieldByName('a', 'A');
        $this->assertTrue($this->clickSubmitByName('go'));
        $this->assertText('a=[A]');
    }
    
    function testFormSubmissionByNameAndAdditionalParameters() {
        $this->get($this->samples() . 'form.html');
        $this->assertTrue($this->clickSubmitByName('go', array('add' => 'A')));
        $this->assertText('go=[Go!]');
        $this->assertText('add=[A]');
    }
    
    function testFormSubmissionBySubmitButtonLabeledSubmit() {
        $this->get($this->samples() . 'form.html');
        $this->assertTrue($this->clickSubmitByName('test'));
        $this->assertText('test=[Submit]');
    }
    
    function testFormSubmissionWithIds() {
        $this->get($this->samples() . 'form.html');
        $this->assertFieldById(1, '');
        $this->assertFieldById(2, 'Default text');
        $this->assertFieldById(3, '');
        $this->assertFieldById(4, 'd1');
        $this->assertFieldById(5, false);
        $this->assertFieldById(6, 'on');
        $this->assertFieldById(8, 'g3');
        $this->assertFieldById(11, 2);
        $this->setFieldById(1, 'aaa');
        $this->setFieldById(2, 'bbb');
        $this->setFieldById(3, 'ccc');
        $this->setFieldById(4, 'D2');
        $this->setFieldById(5, 'on');
        $this->setFieldById(6, false);
        $this->setFieldById(8, 'g2');
        $this->setFieldById(11, 'H1');
        $this->assertTrue($this->clickSubmitById(99));
        $this->assertText('a=[aaa]');
        $this->assertText('b=[bbb]');
        $this->assertText('c=[ccc]');
        $this->assertText('d=[d2]');
        $this->assertText('e=[on]');
        $this->assertNoText('f=[');
        $this->assertText('g=[g2]');
        $this->assertText('h=[1]');
        $this->assertText('go=[Go!]');
    }
    
    function testFormSubmissionWithLabels() {
        $this->get($this->samples() . 'form.html');
        $this->assertField('Text A', '');
        $this->assertField('Text B', 'Default text');
        $this->assertField('Text area C', '');
        $this->assertField('Selection D', 'd1');
        $this->assertField('Checkbox E', false);
        $this->assertField('Checkbox F', 'on');
        $this->assertField('3', 'g3');
        $this->assertField('Selection H', 2);
        $this->setField('Text A', 'aaa');
        $this->setField('Text B', 'bbb');
        $this->setField('Text area C', 'ccc');
        $this->setField('Selection D', 'D2');
        $this->setField('Checkbox E', 'on');
        $this->setField('Checkbox F', false);
        $this->setField('2', 'g2');
        $this->setField('Selection H', 'H1');
        $this->clickSubmit('Go!');
        $this->assertText('a=[aaa]');
        $this->assertText('b=[bbb]');
        $this->assertText('c=[ccc]');
        $this->assertText('d=[d2]');
        $this->assertText('e=[on]');
        $this->assertNoText('f=[');
        $this->assertText('g=[g2]');
        $this->assertText('h=[1]');
        $this->assertText('go=[Go!]');
    }
    
    function testSettingCheckboxWithBooleanTrueSetsUnderlyingValue() {
        $this->get($this->samples() . 'form.html');
        $this->setField('Checkbox E', true);
        $this->assertField('Checkbox E', 'on');
        $this->clickSubmit('Go!');
        $this->assertText('e=[on]');
    }
    
    function testFormSubmissionWithMixedPostAndGet() {
        $this->get($this->samples() . 'form_with_mixed_post_and_get.html');
        $this->setField('Text A', 'Hello');
        $this->assertTrue($this->clickSubmit('Go!'));
        $this->assertText('a=[Hello]');
        $this->assertText('x=[X]');
        $this->assertText('y=[Y]');
    }
    
    function testFormSubmissionWithMixedPostAndEncodedGet() {
        $this->get($this->samples() . 'form_with_mixed_post_and_get.html');
        $this->setField('Text B', 'Hello');
        $this->assertTrue($this->clickSubmit('Go encoded!'));
        $this->assertText('b=[Hello]');
        $this->assertText('x=[X]');
        $this->assertText('y=[Y]');
    }
    
    function testFormSubmissionWithoutAction() {
        $this->get($this->samples() . 'form_without_action.php?test=test');
        $this->assertText('_GET : [test]');
        $this->assertTrue($this->clickSubmit('Submit Post With Empty Action'));
        $this->assertText('_GET : [test]');
        $this->assertText('_POST : [test]');
    }

    function testImageSubmissionByLabel() {
        $this->get($this->samples() . 'form.html');
        $this->assertImage('Image go!');
        $this->assertTrue($this->clickImage('Image go!', 10, 12));
        $this->assertText('go_x=[10]');
        $this->assertText('go_y=[12]');
    }
    
    function testImageSubmissionByLabelWithAdditionalParameters() {
        $this->get($this->samples() . 'form.html');
        $this->assertTrue($this->clickImage('Image go!', 10, 12, array('add' => 'A')));
        $this->assertText('add=[A]');
    }
    
    function testImageSubmissionByName() {
        $this->get($this->samples() . 'form.html');
        $this->assertTrue($this->clickImageByName('go', 10, 12));
        $this->assertText('go_x=[10]');
        $this->assertText('go_y=[12]');
    }
    
    function testImageSubmissionById() {
        $this->get($this->samples() . 'form.html');
        $this->assertTrue($this->clickImageById(97, 10, 12));
        $this->assertText('go_x=[10]');
        $this->assertText('go_y=[12]');
    }
    
    function testButtonSubmissionByLabel() {
        $this->get($this->samples() . 'form.html');
        $this->assertTrue($this->clickSubmit('Button go!', 10, 12));
        $this->assertPattern('/go=\[ButtonGo\]/s');
    }
    
    function testNamelessSubmitSendsNoValue() {
        $this->get($this->samples() . 'form_with_unnamed_submit.html');
        $this->click('Go!');
        $this->assertNoText('Go!');
        $this->assertNoText('submit');
    }
    
    function testNamelessImageSendsXAndYValues() {
        $this->get($this->samples() . 'form_with_unnamed_submit.html');
        $this->clickImage('Image go!', 4, 5);
        $this->assertNoText('ImageGo');
        $this->assertText('x=[4]');
        $this->assertText('y=[5]');
    }
    
    function testNamelessButtonSendsNoValue() {
        $this->get($this->samples() . 'form_with_unnamed_submit.html');
        $this->click('Button Go!');
        $this->assertNoText('ButtonGo');
    }
    
    function testSelfSubmit() {
        $this->get($this->samples() . 'self_form.php');
        $this->assertNoText('[Submitted]');
        $this->assertNoText('[Wrong form]');
        $this->assertTrue($this->clickSubmit());
        $this->assertText('[Submitted]');
        $this->assertNoText('[Wrong form]');
        $this->assertTitle('Test of form self submission');
    }
    
    function testSelfSubmitWithParameters() {
        $this->get($this->samples() . 'self_form.php');
        $this->setFieldByName('visible', 'Resent');
        $this->assertTrue($this->clickSubmit());
        $this->assertText('[Resent]');
    }
    
    function testSettingOfBlankOption() {
        $this->get($this->samples() . 'form.html');
        $this->assertTrue($this->setFieldByName('d', ''));
        $this->clickSubmit('Go!');
        $this->assertText('d=[]');
    }
    
    function testAssertingFieldValueWithPattern() {
        $this->get($this->samples() . 'form.html');
        $this->setField('c', 'A very long string');
        $this->assertField('c', new PatternExpectation('/very long/'));
    }
    
    function testSendingMultipartFormDataEncodedForm() {
        $this->get($this->samples() . 'form_data_encoded_form.html');
        $this->assertField('Text A', '');
        $this->assertField('Text B', 'Default text');
        $this->assertField('Text area C', '');
        $this->assertField('Selection D', 'd1');
        $this->assertField('Checkbox E', false);
        $this->assertField('Checkbox F', 'on');
        $this->assertField('3', 'g3');
        $this->assertField('Selection H', 2);
        $this->setField('Text A', 'aaa');
        $this->setField('Text B', 'bbb');
        $this->setField('Text area C', 'ccc');
        $this->setField('Selection D', 'D2');
        $this->setField('Checkbox E', 'on');
        $this->setField('Checkbox F', false);
        $this->setField('2', 'g2');
        $this->setField('Selection H', 'H1');
        $this->assertTrue($this->clickSubmit('Go!'));
        $this->assertText('a=[aaa]');
        $this->assertText('b=[bbb]');
        $this->assertText('c=[ccc]');
        $this->assertText('d=[d2]');
        $this->assertText('e=[on]');
        $this->assertNoText('f=[');
        $this->assertText('g=[g2]');
        $this->assertText('h=[1]');
        $this->assertText('go=[Go!]');
    }
    
    function testSettingVariousBlanksInFields() {
        $this->get($this->samples() . 'form_with_false_defaults.html');
        $this->assertField('Text A', '');
        $this->setField('Text A', '0');
        $this->assertField('Text A', '0');
        $this->assertField('Text area B', '');
        $this->setField('Text area B', '0');
        $this->assertField('Text area B', '0');
        $this->assertField('Text area C', "                ");
        $this->assertField('Selection D', '');
        $this->setField('Selection D', 'D2');
        $this->assertField('Selection D', 'D2');
        $this->setField('Selection D', 'D3');
        $this->assertField('Selection D', '0');
        $this->setField('Selection D', 'D4');
        $this->assertField('Selection D', '?');
        $this->assertField('Checkbox E', '');
        $this->assertField('Checkbox F', 'on');
        $this->assertField('Checkbox G', '0');
        $this->assertField('Checkbox H', '?');
        $this->assertFieldByName('i', 'on');
        $this->setFieldByName('i', '');
        $this->assertFieldByName('i', '');
        $this->setFieldByName('i', '0');
        $this->assertFieldByName('i', '0');
        $this->setFieldByName('i', '?');
        $this->assertFieldByName('i', '?');
    }
    
    function testSubmissionOfBlankFields() {
        $this->get($this->samples() . 'form_with_false_defaults.html');
        $this->setField('Text A', '');
        $this->setField('Text area B', '');
        $this->setFieldByName('i', '');
        $this->click('Go!');
        $this->assertText('a=[]');
        $this->assertText('b=[]');
        $this->assertPattern('/c=\[                \]/');
        $this->assertText('d=[]');
        $this->assertText('e=[]');
        $this->assertText('i=[]');
    }
    
    function testSubmissionOfEmptyValues() {
        $this->get($this->samples() . 'form_with_false_defaults.html');
        $this->setField('Selection D', 'D2');
        $this->click('Go!');
        $this->assertText('a=[]');
        $this->assertText('b=[]');
        $this->assertText('d=[D2]');
        $this->assertText('f=[on]');
        $this->assertText('i=[on]');
    }
    
    function testSubmissionOfZeroes() {
        $this->get($this->samples() . 'form_with_false_defaults.html');
        $this->setField('Text A', '0');
        $this->setField('Text area B', '0');
        $this->setField('Selection D', 'D3');
        $this->setFieldByName('i', '0');
        $this->click('Go!');
        $this->assertText('a=[0]');
        $this->assertText('b=[0]');
        $this->assertText('d=[0]');
        $this->assertText('g=[0]');
        $this->assertText('i=[0]');
    }
    
    function testSubmissionOfQuestionMarks() {
        $this->get($this->samples() . 'form_with_false_defaults.html');
        $this->setField('Text A', '?');
        $this->setField('Text area B', '?');
        $this->setField('Selection D', 'D4');
        $this->setFieldByName('i', '?');
        $this->click('Go!');
        $this->assertText('a=[?]');
        $this->assertText('b=[?]');
        $this->assertText('d=[?]');
        $this->assertText('h=[?]');
        $this->assertText('i=[?]');
    }

    function testSubmissionOfHtmlEncodedValues() {
        $this->get($this->samples() . 'form_with_tricky_defaults.html');
        $this->assertField('Text A', '&\'"<>');
        $this->assertField('Text B', '"');
        $this->assertField('Text area C', '&\'"<>');
        $this->assertField('Selection D', "'");
        $this->assertField('Checkbox E', '&\'"<>');
        $this->assertField('Checkbox F', false);
        $this->assertFieldByname('i', "'");
        $this->click('Go!');
        $this->assertText('a=[&\'"<>, "]');
        $this->assertText('c=[&\'"<>]');
        $this->assertText("d=[']");
        $this->assertText('e=[&\'"<>]');
        $this->assertText("i=[']");
    }
    
    function testFormActionRespectsBaseTag() {
        $this->get($this->samples() . 'base_tag/form.html');
        $this->assertTrue($this->clickSubmit('Go!'));
        $this->assertText('go=[Go!]');
        $this->assertText('a=[]');
   