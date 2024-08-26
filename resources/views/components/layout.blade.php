<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>
  @vite('resources/css/app.css')
  @vite('resources/css/nav.css')
  @yield('styles')
</head>
<body>
  <nav>
    <div class='head flex justify-between p-2'>
      <h2 class='text-3xl'><a href="/">StoryMD</a></h2>
      <div class='w-1/3 flex justify-between'>
        <a href='/'>Hi, usernamehere!</a>
        <a href='/'>Post</a>
        <a href='/'>Log Out</a>
      </div>
    </div>
    <div class='menu flex justify-between ps-6 pe-2 py-1 bg-gradient-to-b from-sky-600 to-sky-950 text-white'>
      <ul>
        <li><a href="/media">Fandoms</a></li>
        {{-- <ul>
          <li><a href="/media">All Fandoms</a></li>
          <li><a href="/media/">Anime & Manga</a></li>
          <li><a href="/media/">Books & Literature</a></li>
          <li><a href="/media/">Cartoons & Animations</a></li>
          <li><a href="/media/">Celebrities & Real People</a></li>
          <li><a href="/media/">Comics, Graphic Novels, Webtoons, etc.</a></li>
          <li><a href="/media/">Movies</a></li>
          <li><a href="/media/">Music & Bands</a></li>
          <li><a href="/media/">Theater</a></li>
          <li><a href="/media/">TV Shows</a></li>
          <li><a href="/media/">Video Games</a></li>
          <li><a href="/media/">Other Media</a></li>
          <li><a href="/media/">Uncategorized Fandoms</a></li>
        </ul> --}}
        <li><a href="/works">Browse</a></li>
        <li><a href="/works/search">Search</a></li>
        <li><a href="/about">About</a></li>
      </ul>
      <form action='/works/search' method='post' class=''>
        <input type='text' class='me-2 rounded-lg'>
        <input type='submit' value='Search'>
      </form>
    </div>
  </nav>
  
  {{ $slot }}

  <footer class='text-white min-h-40 flex justify-around ps-6 pe-2 py-3 bg-sky-900'>
    <div class='basis-1/6'>
      <h4 class="font-mono">View</h4>
      <ul>
        <li><a href="/">Dark</a></li>
        <li><a href="/">Light</a></li>
        <li><a href="/">Mobile</a></li>
        <li><a href="/">Desktop</a></li>
      </ul>
    </div>
    <div class='basis-1/4'>
      <h4 class="font-mono">About the Repo</h4>
      <ul>
        <li><a href="/">Site Map</a></li>
        <li><a href="/">Diversity Statement</a></li>
        <li><a href="/">Terms of Service</a></li>
        <li><a href="/">DMCA Policy</a></li>
      </ul>
    </div>
    <div class='basis-1/4'>
      <h4 class="font-mono">Contact Us</h4>
      <ul>
        <li><a href="/" class="text-wrap">Policy Questions & Abuse Reports</a></li>
        <li><a href="/">Technical Support & Feedback</a></li>
        <a href="/">FB</a>
        <a href="/">X</a>
      </ul>
    </div>
    <div class='basis-1/6'>
      <h4 class="font-mono">Development</h4>
      <ul>
        <li><a href="/">GitHub</a></li>
        <li><a href="/">YouTube</a></li>
        <li><a href="/">Portfolio</a></li>
      </ul>
    </div>
  </footer>
</body>
</html>