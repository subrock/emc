<!DOCTYPE html>
<html lang="en">
<head>
<meta charset=utf-8 />
<meta name="viewport" content="width=620" />
<title>Environment Management Console - Workflows</title>
<body>
<section id="wrapper">
    <header>
      <h1>Workflow - Object Editor</h1>
    </header>
<article>
  <section>
    <p>Any elements with the <code>contenteditable</code> attribute set will have a grey outline as you hover over. Feel free to edit and change their contents.  I'm using local storage to maintain your changes.</p>
  </section>
  <section id="editable" contenteditable="true">
    <font size=+2>Enter title here.  40 characters max.</font><br>
    <font color=blue><b>Enter description here.  256 characters max.</b></font>
<code><font color=gray>
    <ol>
      <li>#!/bin/sh</li>
      <li>echo "Enter title here."</li>
      <li>echo "Line number will not get written to workflow object."</li>
    </ol>
</font></code>
  </section>
  <div>
    <input type="button" id="clear" value="Clear changes" />
    <input type="submit" id="submit" value="Save changes" />
  </div>
</article>
<script>
var editable = document.getElementById('editable');

addEvent(editable, 'blur', function () {
  // lame that we're hooking the blur event
  localStorage.setItem('contenteditable', this.innerHTML);
  document.designMode = 'off';
});

addEvent(editable, 'focus', function () {
  document.designMode = 'on';
});

addEvent(document.getElementById('clear'), 'click', function () {
  localStorage.clear();
  window.location = window.location; // refresh
});

if (localStorage.getItem('contenteditable')) {
  editable.innerHTML = localStorage.getItem('contenteditable');
}

var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script>
try {
var pageTracker = _gat._getTracker("UA-1656750-18");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
