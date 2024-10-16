@props(['user', 'works'])

<div class='p-5 flex justify-between'>
  <div class='left-pane inline-block align-top w-[15%] min-w-40'>
    <ul class='border-t border-stone-400 text-lg py-3'>
      <li class="hover:bg-stone-200"><a href="#">Dashboard</a></li>
      <li class="hover:bg-stone-200"><a href="#">Profile</a></li>
      @if (auth()->id() == $user->id)
      <li class="hover:bg-stone-200"><a href="#">Preferences</a></li>
      <li class="hover:bg-stone-200"><a href="#">Skins</a></li>
      @endif
    </ul>
    <ul class='border-t border-stone-400 text-lg py-3'>
      <li class="hover:bg-stone-200"><a href="#">Works ({{ count($works) }})</a></li>
      @if (auth()->id() == $user->id)
      <li class="hover:bg-stone-200"><a href="#">Drafts (0)</a></li>
      @endif
      <li class="hover:bg-stone-200"><a href="#">Series (0)</a></li>
      <li class="hover:bg-stone-200"><a href="#">Bookmarks (0)</a></li>
      <li class="hover:bg-stone-200"><a href="#">Collections (0)</a></li>
    </ul>
    <ul class='border-t border-stone-400 text-lg py-3'>
      @if (auth()->id() == $user->id)
      <li class="hover:bg-stone-200"><a href="#">Inbox (0)</a></li>
      <li class="hover:bg-stone-200"><a href="#">Statistics</a></li>
      <li class="hover:bg-stone-200"><a href="#">History</a></li>
      <li class="hover:bg-stone-200"><a href="#">Subscriptions</a></li>
    </ul>
    <ul class='border-t border-stone-400 text-lg py-3'>
      <li class="hover:bg-stone-200"><a href="#">Co-Creator Requests (0)</a></li>
      <li class="hover:bg-stone-200"><a href="#">Assignments (0)</a></li>
      <li class="hover:bg-stone-200"><a href="#">Claims (0)</a></li>
      <li class="hover:bg-stone-200"><a href="#">Related Works (0)</a></li>
      @endif
      <li class="hover:bg-stone-200"><a href="#">Gifts (0)</a></li>
    </ul>
  </div>

  <main class='inline-block w-[80%] pe-5'>
    {{ $slot }}
  </main>
</div>