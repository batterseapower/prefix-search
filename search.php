<?php

$providers = array(
   array("Amazon",array("amazon"),"http://www.amazon.com/s?ie=UTF8&index=blended&link_code=qs&field-keywords={searchTerms}&sourceid=Mozilla-search"),
   array("Amazon A9",array("a9"),"http://www.a9.com/{searchTerms}"),
   array("Answers",array("answers"),"http://www.answers.com/main/ntquery?s={searchTerms}&gwp=13"),
   array("AOL Search",array("aol"),"http://search.aol.com/aol/search?invocationType=searchbox.webhome&query={searchTerms}"),
   array("Ask.com",array("ask"),"http://uk.ask.com/web?q={searchTerms}&search=search&dm=all&qsrc=0&o=312&l=dir&siteid="),
   array("BBC News",array("bbc"),"http://search.bbc.co.uk/cgi-bin/search/results.pl?tab=ns&q={searchTerms}&uri=%2F&scope=all"),
   array("Business.com",array("business"),"http://www.business.com/search/rslt_default.asp?vt=all&type=web&query={searchTerms}&x=0&y=0"),
   array("Creative Commons",array("creativecommons", "cc"),"http://search.creativecommons.org/?q={searchTerms}&sourceid=Mozilla-search"),
   array("Delicious",array("delicious", "del"),"http://delicious.com/search?p={searchTerms}&u=&chk=&context=main&fr=del_icio_us&lc=0"),
   array("Douban",array("douban", "db"),"http://www.douban.com/subject_search?search_submit=%E6%90%9C%E7%B4%A2&search_text={searchTerms}"),
   array("ESPN",array("espn"),"http://search.espn.go.com/{searchTerms}/"),
   array("Expedia",array("expedia"),"http://search.expedia.com/socialsearch/query?q={searchTerms}&x=0&y=0&cn=expedia&cc=www&st=1&bn_f=&adv=0"),
   array("Flickr",array("flickr"),"http://www.flickr.com/search/?q={searchTerms}"),
   array("Google",array("google", "goog", "g"),"http://www.google.com/search?q={searchTerms}"),
   array("Hoogle",array("hoogle", "hoog"),"http://haskell.org/hoogle/?hoogle={searchTerms}"),
   array("Holumbus",array("holumbus"),"http://www.holumbus.org/hayoo/hayoo.html?query={searchTerms}"),
   array("Hollywood",array("hollywood"),"http://www.hollywood.com/search.aspx?s={searchTerms}"),
   array("IMDB",array("imdb"),"http://www.imdb.com/find?s=all&q={searchTerms}&x=0&y=0"),
   array("JavaDocs",array("jd", "javadocs"), "http://javadocs.org/{searchTerms}/?t={searchTerms}"),
   array("Live.com",array("live"),"http://search.live.com/results.aspx?q={searchTerms}&go=&form=QBLH"),
   array("Lonely Planet",array("lonelyplanet"),"http://search.lonelyplanet.com/search.do?Ntt={searchTerms}&x=0&y=0"),
   array("MarketWatch",array("marketwatch"),"http://www.marketwatch.com/search/?value={searchTerms}"),
   array("Merriam-Webster",array("merriamwebster", "dictionary", "dict"),"http://www.merriam-webster.com/dictionary/{searchTerms}"),
   array("Nciku",array("nciku", "zw"),"http://www.nciku.com/search/all/{searchTerms}"),
   array("Rotten Tomatoes",array("rottentomatoes", "rt"),"http://www.rottentomatoes.com/search/full_search.php?search={searchTerms}"),
   array("Reviewing The Kanji",array("kanji", "rtk"),"http://kanji.koohii.com/study/index.php?search={searchTerms}"),
   array("Technorati",array("technorati"),"http://technorati.com/search/{searchTerms}?authority=a4&language=en"),
   array("USA Today",array("usatoday"),"http://search.usatoday.com/search/search.aspx?qt=news%2Cyss%2Cweb%2Crel%2Cimg%2Ctop10%2Ckmatch&nr=5&s=sb&kw={searchTerms}"),
   array("Weather.com",array("weather"),"http://www.weather.com/search/enhancedlocalsearch?whatprefs=&what=WeatherLocalUndeclared&lswe={searchTerms}&lswa=WeatherLocalUndeclared&from=searchbox&where={searchTerms}&wxGoButton=GO"),
   array("Wikipedia",array("wikipedia", "wp"),"http://en.wikipedia.org/wiki/Special:Search?search={searchTerms}&fulltext=Search"),
   array("Yahoo",array("yahoo"),"http://search.yahoo.com/search?p={searchTerms}&ei=UTF-8&fr=moz2"),
   array("Yahoo Answers",array("yahooanswers"),"http://answers.yahoo.com/search/search_result;_ylv=3?p={searchTerms}"),
   array("YellowBridge", array("yb", "yellowbridge"),"http://www.yellowbridge.com/chinese/wordsearch.php?searchMode=C&select=anywhere&word={searchTerms}"));

# Find user query
$query = $_GET['query'];

# Parse query term into initial subquery and actual query text
if (preg_match("/^([^\\s]+)\\s+(.*)$/", $query, $matches)) {
   # Extract relevant stuff from the regex gubbins
   $provider_string = strtolower($matches[1]);
   $subquery = $matches[2];

   # Find a matching template
   $template = NULL;
   foreach ($providers as $i => $provider) {
      $provider_strings = $provider[1];
      $provider_template = $provider[2];
      if (is_numeric(array_search($provider_string, $provider_strings))) {
         $template = $provider_template;
         break;
      }
   }
   
   # Redirect immediately if we recognised the template
   if ($template) {
      http_redirect(str_replace("{searchTerms}", urlencode($subquery), $template));
      return;
   }
}

# Default redirection
http_redirect("http://www.google.com/search?q=" . urlencode($query));

?>