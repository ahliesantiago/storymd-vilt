<x-layout :title="'New Work | StoryMD'">
  <div class="px-10 py-8">
    <h2 class="text-4xl font-serif mb-1">Post New Work</h2>

    <form action="/works" method="post">
      @csrf

      <div class="table-form bg-neutral-300">
        <h3 class="creation-type">Preface</h3>
        <table>
          <tr>
            <td><label for="title">Work Title</label></td>
            <td>
              <input type="text" name="title" id="title" />
              <p class="text-sm mt-1 flex justify-between">
                @error('title')
                <span class="text-red-500">{{ $message }}</span>                
                @enderror
                <span class="mr-3 ml-auto">255 characters left</span>
              </p>
            </td>
          </tr>
          <tr>
            <td><label for="expected_chapter_count">Estimate number of Chapters</label></td>
            <td><input type="number" name="expected_chapter_count" id="expected_chapter_count" /></td>
          </tr>
          <tr>
            <td><label for="summary">Summary</label></td>
            <td>
              <textarea name="summary" id="summary" rows="5" class="w-full resize-none"></textarea>
              <p class="text-sm mt-1 flex justify-between">
                @error('summary')
                <span class="text-red-500">{{ $message }}</span>                
                @enderror
                <span class="mr-3 ml-auto">1,250 characters left</span>
              </p>
            </td>
          </tr>
          <tr>
            <td>Notes</td>
            <td>
              <div>
                <input type="checkbox" class="ml-2 mr-4" name="has_beginning_notes" id="has_beginning_notes" />
                <label for="has_beginning_notes">at the beginning</label>
              </div>
              <div class="mt-2 mb-5">
                <textarea name="beginning_notes" id="" rows="8" class="w-full"></textarea>
                <p class="text-sm text-right mt-1 mr-3">5,000 characters left</p>
              </div>
              <div>
                <input type="checkbox" class="ml-2 mr-4" name="has_end_notes" id="has_end_notes" />
                <label for="has_end_notes">at the end</label>
              </div>
              <div class="mt-2 mb-5">
                <textarea name="end_notes" id="" rows="8" class="w-full"></textarea>
                <p class="text-sm text-right mt-1 mr-3">5,000 characters left</p>
              </div>
            </td>
          </tr>
          <tr>
            <td><label for="language_code">Language</label></td>
            <td>
              <select name="language_code" id="language_code">
                @foreach($languages as $language)
                <option
                  value="{{$language['language_code']}}"
                  @if ($language['language_code'] == 'en') selected @endif
                >
                  {{$language['language_name']}}
                </option>
                @endforeach
              </select>
            </td>
          </tr>
        </table>
      </div>

      <div class="table-form bg-neutral-300">
        <h3 class="creation-type">Tags</h3>
        <table>
          <tr>
            <td><label for="rating_id">Rating</label></td>
            <td>
              <select name="rating_id" id="rating_id">
                @foreach($ratings as $rating)
                <option value="{{$rating['id']}}">{{$rating['rating_name']}}</option>
                @endforeach
              </select>
            </td>
          </tr>
          <tr>
            <td>Archive Warnings</td>
            <td>
              <div class="options">
                <ul>
                  @foreach($warnings as $warning)
                  <li>
                    <label>
                      <input
                        type="checkbox"
                        class="ml-1"
                        name="warnings[]"
                        value="{{$warning['id']}}"
                        @if ($warning['id'] == 1) checked @endif
                      >
                      {{$warning['warning_name']}}
                    </label>
                  </li>
                  @endforeach
                </ul>
              </div>
            </td>
          </tr>
          <tr>
            <td><label for="fandoms">Fandoms</label></td>
            <td>
              <select name="fandoms" id="fandoms">
                <option disabled selected>Select a fandom</option>
                @foreach ($fandoms as $fandom)
                <option value={{$fandom['id']}}>{{$fandom['fandom_name']}}</option>
                @endforeach
              </select>
              @error('fandoms')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
              {{-- Select is temporary, will be changed to a search that will allow multi-selection once front-end framework is used --}}
              {{-- <input type="search" name="fandoms" id="fandoms" /> --}}
            </td>
          </tr>
          <tr>
            <td>Categories</td>
            <td>
              <div class="options">
                <ul>
                  @foreach($categories as $category)
                  <li>
                    <label>
                      <input
                        type="checkbox"
                        class="ml-1"
                        name="categories[]"
                        value="{{$category['id']}}"
                        @if ($category['id'] == 5) checked @endif
                      >
                      {{$category['category_name']}}
                    </label>
                  </li>
                  @endforeach
                </ul>
              </div>
          </tr>
          <tr>
            <td><label for="relationships">Relationships</label></td>
            <td>
              <select name="relationships" id="relationships">
                <option disabled selected>Select a relationship</option>
                @foreach ($relationships as $relationship)
                <option value={{$relationship['id']}}>{{$relationship['tag_name']}}</option>
                @endforeach
              </select>
              {{-- Select is temporary, will be changed to a search that will allow multi-selection once front-end framework is used --}}
              {{-- <input type="search" name="relationships" id="relationships" /> --}}
            </td>
          </tr>
          <tr>
            <td><label for="characters">Characters</label></td>
            <td>
              <select name="characters" id="characters">
                <option disabled selected>Select a character</option>
                @foreach ($characters as $character)
                <option value={{$character['id']}}>{{$character['tag_name']}}</option>
                @endforeach
              </select>
              {{-- Select is temporary, will be changed to a search that will allow multi-selection once front-end framework is used --}}
              {{-- <input type="search" name="characters" id="characters" /> --}}
            </td>
          </tr>
          <tr>
            <td><label for="additional_tags">Additional Tags</label></td>
            <td>
              <select name="additional_tags" id="additional_tags">
                <option disabled selected>Select additional tags</option>
                @foreach ($additional_tags as $tag)
                <option value={{$tag['id']}}>{{$tag['tag_name']}}</option>
                @endforeach
              </select>
              {{-- Select is temporary, will be changed to a search that will allow multi-selection once front-end framework is used --}}
              {{-- <input type="search" name="additional_tags" id="additional_tags" /> --}}
            </td>
          </tr>
        </table>
      </div>

      <div class="table-form bg-neutral-300">
        <h3 class="creation-type">Privacy</h3>
        <table>
          <tr>
            <td>Story visibility</td>
            <td>
              <div class="options">
                <div>
                  <input type="radio" checked name="privacy" value="public" id="public_viewing" />
                  <label for="public_viewing">Public</label>
                </div>
                <div>
                  <input type="radio" name="privacy" value="registered_only" id="registered_only_viewing" />
                  <label for="registered_only_viewing">Only show to registered users</label>
                </div>
                <div>
                  <input type="radio" name="privacy" value="private" id="private" />
                  <label for="private">Private</label>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>Commenting options</td>
            <td>
              <div>
                <input type="checkbox" class="ml-2 mr-1" name="is_comment_moderated" id="is_comment_moderated" />
                <label for="is_comment_moderated">Enable comment moderation</label>
              </div>
              <div class="options mt-2">
                <div>
                  <input type="radio" name="commenting_rule" value="public" id="public_commenting" />
                  <label for="public_commenting">Registered users and guests can comment</label>
                </div>
                <div>
                  <input type="radio" checked name="commenting_rule" value="registered_only" id="registered_only_commenting" />
                  <label for="registered_only_commenting">Only registered users can comment</label>
                </div>
                <div>
                  <input type="radio" name="commenting_rule" value="off" id="off" />
                  <label for="off">No one can comment</label>
                </div>
              </div>
            </td>
          </tr>
        </table>
      </div>

      <div class="table-form bg-neutral-300 p-6">
        <h3 class="creation-type">Work Content</h3>
        <textarea class="mt-10 w-full border-r-" name="content" id="content" rows="30"></textarea>
        <p class="text-sm mt-1 flex justify-between">
          @error('content')
          <span class="text-red-500">{{ $message }}</span>                
          @enderror
          <span class="mr-3 ml-auto">500,000 characters left</span>
        </p>
      </div>

      <div class="text-right pr-4">
        <button class="border border-red-500 bg-transparent">Cancel</button>
        <button class="border border-red-500 bg-transparent">Reset</button>
        <button class="border border-sky-500 bg-transparent">Save as Draft</button>
        <button class="bg-sky-600 border text-white">Preview</button>
        <button class="bg-sky-700 text-white">Post</button>
      </div>
    </form>
  </div>
</x-layout>