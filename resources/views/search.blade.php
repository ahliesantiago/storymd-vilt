<x-layout :title="'Search | StoryMD'">
  <form action="/" method="GET">
    <p>Work Info</p>
    <label for="query">Search any field:</label>
    <input type="text" name="query" placeholder="Search within the work">
    <label for="title">Work Title</label>
    <input type="text" name="title">
    <label for="creators">Author/Artist/Creator</label>
    <input type="text" name="creators">
    <label for="modified_at">Date last modified</label>
    <input type="text" name="modified_at">
    <label for="modified_date_from">Date from</label>
    <input type="text" name="modified_date_from">
    <label for="modified_date_to">Date to</label>
    <input type="text" name="modified_date_to">
    <label for="isComplete">Completion status</label>
    <ul class="list-none">
      <li>
        <input type="radio" name="isComplete" id="complete-both" value="either">
        <label for="complete-true">All works</label>
      </li>
      <li>
        <input type="radio" name="isComplete" id="complete-true" value="true">
        <label for="complete-true">Complete works only</label>
      </li>
      <li>
        <input type="radio" name="isComplete" id="complete-false" value="false">
        <label for="complete-true">Works in progress only</label>
      </li>
    </ul>
    <label for="hasCrossover">Crossovers</label>
    <ul class="list-none">
      <li>
        <input type="radio" name="hasCrossover" id="crossover-true" value="true">
        <label for="crossover-true">Include crossovers</label>
      </li>
      <li>
        <input type="radio" name="hasCrossover" id="crossover-false" value="false">
        <label for="crossover-true">Exclude crossovers</label>
      </li>
      <li>
        <input type="radio" name="hasCrossover" id="crossover-only" value="only">
        <label for="crossover-true">Only crossovers</label>
      </li>
    </ul>
    <label for="oneshot">Single chapter</label>
    <input type="checkbox" name="oneshot">
    <label for="word_count">Word Count</label>
    <input type="text" name="word_count">
    <label for="language_id">Language</label>
    <select name="language_id" id="language_id">
      <option value="afr">Afrikaans</option>
      <option value="eng">English</option>
    </select>

    <p>Work Tags</p>
    <label for="tag_ids">Official Tags</label>
    <input type="search" name="tag_ids">
    <label for="fandom_names">Fandoms</label>
    <input type="search" name="fandom_names">
    <label for="rating_ids">Rating</label>
    <select name="rating_ids" id="rating_ids">
      <option value="" selected>Any</option>
      <option value="">Not Rated</option>
      <option value="">General Audiences</option>
      <option value="">Teen and Up Audiences</option>
      <option value="">Mature</option>
      <option value="">Explicit</option>
    </select>
    <label for="warning_ids">Warnings</label>
    <ul class="list-none">
      <li>
        <input type="checkbox" name="warning_ids" id="none" value="none">
        <label for="none">Creator Chose Not To Use Warnings</label>
      </li>
      <li>
        <input type="checkbox" name="warning_ids" id="na" value="na">
        <label for="na">No Repo Warnings Apply</label>
      </li>
      <li>
        <input type="checkbox" name="warning_ids" id="violence" value="violence">
        <label for="violence">Graphic Depictions Of Violence</label>
      </li>
      <li>
        <input type="checkbox" name="warning_ids" id="death" value="death">
        <label for="death">Major Character Death</label>
      </li>
      <li>
        <input type="checkbox" name="warning_ids" id="suicide" value="suicide">
        <label for="suicide">Graphic Depictions of Suicide or Suicidal Thoughts</label>
      </li>
      <li>
        <input type="checkbox" name="warning_ids" id="noncon" value="noncon">
        <label for="noncon">Rape/Non-Con</label>
      </li>
      <li>
        <input type="checkbox" name="warning_ids" id="underage" value="underage">
        <label for="underage">Underage</label>
      </li>
    </ul>
    <label for="category_ids">Categories</label>
    <ul class="list-none">
      <li>
        <input type="checkbox" name="category_ids" id="ff" value="ff">
        <label for="ff">F/F</label>
      </li>
      <li>
        <input type="checkbox" name="category_ids" id="fm" value="fm">
        <label for="fm">F/M</label>
      </li>
      <li>
        <input type="checkbox" name="category_ids" id="gen" value="gen">
        <label for="gen">Gen</label>
      </li>
      <li>
        <input type="checkbox" name="category_ids" id="mm" value="mm">
        <label for="mm">M/M</label>
      </li>
      <li>
        <input type="checkbox" name="category_ids" id="multi" value="multi">
        <label for="multi">Multi</label>
      </li>
      <li>
        <input type="checkbox" name="category_ids" id="category-other" value="category-other">
        <label for="category-other">Other</label>
      </li>
    </ul>
    <label for="character_names">Characters</label>
    <input type="search" name="character_names">
    <label for="relationship_names">Relationships</label>
    <input type="search" name="relationship_names">
    <label for="other_tags">Other (official) tags</label>
    <input type="search" name="other_tags">
    <label for="freeform_tags">Additional tags</label>
    <input type="search" name="freeform_tags">

    <p>Exclude</p>
    <label for="exclude_character_names">Exclude characters</label>
    <input type="search" name="exclude_character_names">
    <label for="exclude_relationship_names">Exclude relationships</label>
    <input type="search" name="exclude_relationship_names">
    <label for="exclude_tags">Exclude tags</label>
    <input type="search" name="exclude_tags">

    <p>Work Stats</p>
    <label for="hit_count">At least this number of hits</label>
    <input type="number" name="hit_count">
    <label for="kudos_count">At least this number of kudos</label>
    <input type="number" name="kudos_count">
    <label for="comments_count">At least this number of comments</label>
    <input type="number" name="comments_count">
    <label for="bookmarks_count">At least this number of bookmarks</label>
    <input type="number" name="bookmarks_count">
    <label for="word_count">Word count</label>
    <label for="word_count_from">Word from</label>
    <input type="number" name="word_count_from">
    <label for="word_count_to">Word to</label>
    <input type="number" name="word_count_to">

    <p>Search</p>
    <label for="sort_by">Sort by</label>
    <select name="sort_by" id="sort_by">
      <option value="">Best match</option>
      <option value="">Author</option>
      <option value="">Title</option>
      <option value="">Date posted</option>
      <option value="">Date updated</option>
      <option value="">Word count</option>
      <option value="">Hit count</option>
      <option value="">Kudos count</option>
      <option value="">Comment count</option>
      <option value="">Bookmark count</option>
    </select>
    <label for="sort_direction">Sort direction</label>
    <select name="" id="">
      <option value="">Ascending</option>
      <option value="">Descending</option>
    </select>
    <label for=""></label>
    <input type="text" name="">
    <input type="text" name="tag_id">
    <input type="button" name="commit" value="Search">
    <input type="button" name="commit" value="Sort and Filter">
  </form>
</x-layout>