<x-layout :title="'Profile'">
  <x-profile-layout :user="$user" :works="$works">
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
  </x-profile-layout>
</x-layout>