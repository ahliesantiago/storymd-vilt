<template>
  <nav>
    <div class='head flex justify-between p-2'>
      <h2 class='text-3xl'>StoryMD</h2>
      <div>
        <a href='/'>Hi, user!</a>
        <a href='/'>Post</a>
        <a href='/'>Log Out</a>
      </div>
    </div>
    <div class='menu flex justify-between px-2 py-1 bg-gradient-to-b from-red-700 to-red-950'>
      <ul>
        <li>Fandoms</li>
        <li>Browse</li>
        <li>Search</li>
        <li>About</li>
      </ul>
      <form action='/works/search' method='post'>
        <input type='text'>
        <input type='submit' value='Search'>
      </form>
    </div>
  </nav>
  <div>
    <h2></h2>

  </div>
</template>