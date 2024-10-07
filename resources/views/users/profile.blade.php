<x-layout :title="'Profile'">
  <div class='p-5 flex justify-between'>
    <div class='left-pane inline-block align-top w-[23%]'>
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
    <main class='inline-block w-[75%] pe-5'>
      <h1 class='text-right text-3xl border-b border-black'>{{ $user->username }}</h1>
      <div class="buttons mt-2 text-right">
        @if (auth()->id() == $user->id)
        <x-button>Post New</x-button>
        <x-button>Edit Works</x-button>
        <x-button>Invitations</x-button>
        @else
        <x-button>Subscribe</x-button>
        <x-button>Block</x-button>
        <x-button>Mute</x-button>
        @endif
      </div>
      @unless ($works == null)
      <div class='works mt-3 border border-stone-400'>
        <h2 class='bg-stone-200 p-3 text-xl'>Recent Works</h2>
      @foreach ($works->take(5) as $work)
        @if($work->chapters->first()['is_published'] && $work['privacy'] != 'private')
        <x-work-card :work="$work" class='m-2' />
        @endif
      @endforeach
      @if (count($works) > 5)
        <div class='text-right p-2 bg-stone-200'>
          <x-button>View all works ({{ count($works) }})</x-button>
        </div>    
      @endif
      </div>
      @else
      <p>There are no works <!-- or bookmarks --> under this name yet.</p>
      @endif
    </main>
  </div>
</x-layout>