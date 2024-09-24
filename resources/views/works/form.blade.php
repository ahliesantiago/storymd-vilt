<x-layout :title="$type == 'create' ? 'New Work' : 'Edit Work' . ' | StoryMD'">
  <div class="px-10 py-8">
    <h2 class="text-4xl font-serif mb-1">
      {{ $type == 'create'
        ? "Post New Work"
        : "Edit '$work->title'"
      }}
    </h2>
    
    <form action="/works{{ isset($work) ? '/' . $work->id : '' }}" method="POST" enctype="multipart/form-data">
      @csrf
      @if ($type == 'edit') @method('PUT') @endif
      <div class="table-form bg-neutral-300">
        <h3 class="creation-type">Preface</h3>
        <table>
          <tr>
            <td><label for="title">Work Title</label></td>
            <td>
              <input type="text" name="title" id="title" value="{{ $work->title ?? old('title') }}" />
              <p class="text-sm mt-1 flex justify-between">
                @error('title')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
                <span class="mr-3 ml-auto">255 characters left</span>
              </p>
            </td>
          </tr>
          <tr>
            <td><label for="expected_chapter_count">Estimate number of chapters</label></td>
            <td><input type="number" name="expected_chapter_count" id="expected_chapter_count" value="{{$work->expected_chapter_count ?? old('expected_chapter_count')}}" /></td>
          </tr>
          <tr>
            <td><label for="summary">Summary</label></td>
            <td>
              {{-- <textarea name="summary" id="summary" rows="5" class="w-full resize-none">{{old('summary')}}</textarea> --}}
              <textarea name="summary" id="summary" rows="5" class="w-full resize-none">{{isset($work) ? $work->chapters->first()->summary : old('summary')}}</textarea>
              <p class="text-sm mt-1 flex justify-between">
                @error('summary')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
                <span class="mr-3 ml-auto">1,250 characters left</span>
              </p>
            </td>
          </tr>
          <tr>
            <td><label for="cover_image">Cover image</label></td>
            <td>
              <input type="file" name="cover_image">
              @if (isset($work) && $work->cover_image)
                <img class="mt-2" src="{{ asset('storage/' . $work->cover_image) }}" />
              @endif
            </td>
          </tr>
          @if ($type == 'create')
          <tr>
            <td>Notes</td>
            <td>
              <div>
                <input type="checkbox" class="ml-2 mr-4" name="has_beginning_notes" id="has_beginning_notes" {{ old('has_beginning_notes') == "on" ? 'checked' : '' }} />
                <label for="has_beginning_notes">at the beginning</label>
              </div>
              <div class="mt-2 mb-5">
                <textarea name="beginning_notes" id="beginning_notes" rows="8" class="w-full">{{old('beginning_notes')}}</textarea>
                <p class="text-sm text-right mt-1 mr-3">5,000 characters left</p>
              </div>
              <div>
                <input type="checkbox" class="ml-2 mr-4" name="has_end_notes" id="has_end_notes" {{ old('has_end_notes') == "on" ? 'checked' : '' }} />
                <label for="has_end_notes">at the end</label>
              </div>
              <div class="mt-2 mb-5">
                <textarea name="end_notes" id="end_notes" rows="8" class="w-full">{{old('end_notes')}}</textarea>
                <p class="text-sm text-right mt-1 mr-3">5,000 characters left</p>
              </div>
            </td>
          </tr>
          @endif
          <tr>
            <td><label for="language_code">Language</label></td>
            <td>
              <select name="language_code" id="language_code">
                @foreach ($languages as $language)
                <option
                  value={{$language['language_code']}}
                  @if (
                    !isset($work) && $language['language_code'] == 'en' && empty(old('language_code'))
                    || $language['language_code'] == old('language_code')
                    || isset($work) && $language['language_code'] == $work->language_code
                  )
                    selected
                  @endif
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
                <option
                  value={{$rating['id']}}
                  @if (
                    !isset($work) && $rating['id'] == 'en' && empty(old('rating_id'))
                    || $rating['id'] == old('rating_id')
                    || isset($work) && $rating['id'] == $work->rating->id
                  )
                    selected
                  @endif
                >
                  {{$rating['rating_name']}}
                </option>
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
                        @if (
                          !isset($work) && $warning['id'] == 1 && empty(old('warnings'))
                          || in_array($warning['id'], old('warnings', []))
                          || isset($work) && in_array($warning['id'], $work->warnings->pluck('id')->toArray())
                        )
                          checked
                        @endif
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
                <option disabled {{ !isset($work) && old('fandoms') == null ? 'selected' : '' }}>Select a fandom</option>
                @foreach ($fandoms as $fandom)
                <option
                  value={{$fandom['id']}} {{ old('fandoms') == $fandom['id'] ? 'selected' : '' }}
                  @if (
                    $fandom['id'] == old('fandoms')
                    || isset($work) && in_array($fandom['id'], $work->fandoms->pluck('id')->toArray())
                  )
                    selected
                  @endif
                >
                  {{$fandom['fandom_name']}}
                </option>
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
                        @if (
                          !isset($work) && $category['id'] == 5 && empty(old('categories'))
                          || in_array($category['id'], old('categories', []))
                          || isset($work) && in_array($category['id'], $work->categories->pluck('id')->toArray())
                        )
                          checked
                        @endif
                      >
                      {{$category['category_name']}}
                    </label>
                  </li>
                  @endforeach
                </ul>
              </div>
              @error('categories')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </td>
          </tr>
          <tr>
            <td><label for="relationships">Relationships</label></td>
            <td>
              <select name="relationships" id="relationships">
                <option disabled {{ !isset($work) && old('relationships') == null ? 'selected' : '' }}>Select a relationship</option>
                @foreach ($relationships as $relationship)
                <option
                  value={{$relationship['id']}} {{ old('relationships') == $relationship['id'] ? 'selected' : '' }}
                  @if (
                    $relationship['id'] == old('relationships')
                    || isset($work) && in_array($relationship['id'], $work->tags->pluck('id')->toArray())
                  )
                    selected
                  @endif
                >
                  {{$relationship['tag_name']}}
                </option>
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
                <option disabled {{ !isset($work) && old('characters') == null ? 'selected' : '' }}>Select a character</option>
                @foreach ($characters as $character)
                <option
                  value={{$character['id']}} {{ old('characters') == $character['id'] ? 'selected' : '' }}
                  @if (
                    $character['id'] == old('characters')
                    || isset($work) && in_array($character['id'], $work->tags->pluck('id')->toArray())
                  )
                    selected
                  @endif
                >
                  {{$character['tag_name']}}
                </option>
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
                <option disabled {{ !isset($work) && old('additional_tags') == null ? 'selected' : '' }}>Select additional tags</option>
                @foreach ($additional_tags as $tag)
                <option
                  value={{$tag['id']}} {{ old('additional_tags') == $tag['id'] ? 'selected' : '' }}
                  @if (
                    $tag['id'] == old('additional_tags')
                    || isset($work) && in_array($tag['id'], $work->tags->pluck('id')->toArray())
                  )
                    selected
                  @endif
                >
                  {{$tag['tag_name']}}
                </option>
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
                  <input type="radio" name="privacy" value="public" id="public_viewing" {{ old('privacy') == "public" || old('privacy') == null ? 'checked' : '' }} />
                  <label for="public_viewing">Public</label>
                </div>
                <div>
                  <input type="radio" name="privacy" value="registered_only" id="registered_only_viewing" {{ old('privacy') == "registered_only" ? 'checked' : '' }} />
                  <label for="registered_only_viewing">Only show to registered users</label>
                </div>
                <div>
                  <input type="radio" name="privacy" value="private" id="private" {{ old('privacy') == "private" ? 'checked' : '' }} />
                  <label for="private">Private</label>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>Commenting options</td>
            <td>
              <div>
                <input type="checkbox" class="ml-2 mr-1" name="is_comment_moderated" id="is_comment_moderated" {{ old('is_comment_moderated') == "on" ? 'checked' : '' }} />
                <label for="is_comment_moderated">Enable comment moderation</label>
              </div>
              <div class="options mt-2">
                <div>
                  <input type="radio" name="commenting_rule" value="public" id="public_commenting" {{ old('commenting_rule') == "public" ? 'checked' : '' }} />
                  <label for="public_commenting">Registered users and guests can comment</label>
                </div>
                <div>
                  <input type="radio" name="commenting_rule" value="registered_only" id="registered_only_commenting" {{ old('commenting_rule') == "registered_only" || old('commenting_rule') == null ? 'checked' : '' }} />
                  <label for="registered_only_commenting">Only registered users can comment</label>
                </div>
                <div>
                  <input type="radio" name="commenting_rule" value="off" id="off" {{ old('commenting_rule') == "off" ? 'checked' : '' }} />
                  <label for="off">No one can comment</label>
                </div>
              </div>
            </td>
          </tr>
        </table>
      </div>

      @if ($type == 'create')
      <div class="table-form bg-neutral-300 p-6">
        <h3 class="creation-type">Work Content</h3>
        <textarea class="mt-10 w-full" name="content" id="content" rows="30">{{old('content')}}</textarea>
        <p class="text-sm mt-1 flex justify-between">
          @error('content')
          <span class="text-red-500">{{ $message }}</span>
          @enderror
          <span class="mr-3 ml-auto">500,000 characters left</span>
        </p>
      </div>
      @endif

      <div class="text-right pr-4">
        <button class="border border-red-500 bg-transparent">Cancel</button>
        <button class="border border-red-500 bg-transparent">Reset</button>
        <button class="border border-sky-500 bg-transparent">Save as Draft</button>
        <button class="bg-sky-600 border text-white">Preview</button>
        <button class="bg-sky-700 text-white">{{ $type == 'create' ? 'Post' : 'Update' }}</button>
      </div>
    </form>
  </div>
</x-layout>