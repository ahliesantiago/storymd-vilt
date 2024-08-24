<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>StoryMd</title>
</head>
<body>
  <nav>
    <div class='head flex justify-between p-2'>
      <h2 class='text-3xl'><a href="/">StoryMD</a></h2>
      <div class='w-1/4 flex justify-between'>
        <a href='/'>Hi, {{ $user }}!</a>
        <a href='/'>Post</a>
        <a href='/'>Log Out</a>
      </div>
    </div>
    <div class='menu flex justify-between ps-6 pe-2 py-1 bg-gradient-to-b from-sky-600 to-sky-950'>
      <ul>
        <li><a href="/">Fandoms</a></li>
        <li><a href="/browse">Browse</a></li>
        <li><a href="/">Search</a></li>
        <li><a href="/">About</a></li>
      </ul>
      <form action='/works/search' method='post' class=''>
        <input type='text' class='me-2 rounded-lg'>
        <input type='submit' value='Search'>
      </form>
    </div>
  </nav>
  <main>
    <p class='message'></p>
    <div class='homePanels favorites'>
      <h2>Favorites</h2>
      <ul>
        <li></li>
      </ul>
    </div>
    <div class='homePanels notifications'>
      <h2>Notifications & messages</h2>
      
    </div>
    <div class='homePanels bookmarks'>
      <h2>Bookmarks</h2>
      
    </div>
    <div class='homePanels later'>
      <h2>Is it later already?</h2>
      
    </div>
    <div class='homePanels news'>
      <h2>News</h2>
      
    </div>
    <div class='homePanels links'>
      <h2>Follow us</h2>
      
    </div>
  </main>
  <footer class='text-white min-h-40 flex justify-around ps-6 pe-2 py-3 bg-sky-900'>
    <div class='basis-1/6'>
      <h4>View</h4>
      <ul>
        <li><a href="/">Dark</a></li>
        <li><a href="/">Light</a></li>
        <li><a href="/">Mobile</a></li>
        <li><a href="/">Desktop</a></li>
      </ul>
    </div>
    <div class='basis-1/4'>
      <h4>About the Repo</h4>
      <ul>
        <li><a href="/">Site Map</a></li>
        <li><a href="/">Diversity Statement</a></li>
        <li><a href="/">Terms of Service</a></li>
        <li><a href="/">DMCA Policy</a></li>
      </ul>
    </div>
    <div class='basis-1/4'>
      <h4>Contact Us</h4>
      <ul>
        <li><a href="/" class="text-wrap">Policy Questions & Abuse Reports</a></li>
        <li><a href="/">Technical Support & Feedback</a></li>
        <a href="/">FB</a>
        <a href="/">X</a>
      </ul>
    </div>
    <div class='basis-1/6'>
      <h4>Development</h4>
      <ul>
        <li><a href="/">GitHub</a></li>
        <li><a href="/">YouTube</a></li>
        <li><a href="/">Portfolio</a></li>
      </ul>
    </div>
  </footer>
</body>
</html>