@section('styles')
  @vite('resources/css/home.css')
@endsection

<x-layout :title="'StoryMD'">
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
</x-layout>