<x-layout :title="$type == 'registration' ? 'Registration' : 'Login' ">
  <div class="min-w-[400px] max-w-[500px] m-3 py-3 ps-6 bg-neutral-300 rounded-md">
    <h1 class="text-3xl">
      {{ $type == 'registration' ? 'Registration' : 'Login' }}
    </h1>
    <form action="/users{{ $type == 'login' ? '/authenticate' : '' }}" method="POST">
      @csrf
      <table class='mt-3'>
        @if ($type == 'registration')
        <tr>
          <td class='min-w-1/3 align-top'>
            <label for="email">E-mail address</label>
          </td>
          <td class='ps-10'>
            @error('email')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="border border-black">
          </td>
        </tr>
        <tr>
          <td class='min-w-1/3 align-top'>
            <label for="username">Username</label>
          </td>
          <td class='ps-10'>
            @error('username')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="text" name="username" id="username" value="{{ old('username') }}" class="border border-black">
          </td>
        </tr>          
        @else
        <tr>
          <td class='min-w-1/3 align-top'>
            <label for="login_mode">Email or username</label>
          </td>
          <td class='ps-10'>
            <input type="text" name="login_mode" id="login_mode" value="{{ old('login_mode') }}" class="border border-black">
            @error('login_mode')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
          </td>
        </tr>
        @endif
        <tr>
          <td class='min-w-1/3'><label for="password">Password</label></td>
          <td class='ps-10'>
            @error('password')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="password" name="password" id="password" class="border border-black">
          </td>
        </tr>
        @if ($type == 'login')
        <tr>
          <td>
            <p href="/password-reset" class="text-blue-700">
              Forgot password?
            </p>            
          </td>
        </tr>
        @endif
        @if ($type == 'registration')
        <tr>
          <td class='min-w-1/3 align-top'><label for="password_confirmation">Confirm password</label></td>
          <td class='ps-10'>
            <input type="password" name="password_confirmation" id="password_confirmation" class="border border-black">
          </td>
        </tr>
        <tr>
          <td class='min-w-1/3 align-top'>
            <label for="birthdate">Birthdate</label>
          </td>
          <td class='ps-10'>
            <input type="date" name="birthdate" id="birthdate" class="border border-black w-[173px]">
            @error('birthdate')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
          </td>
        </tr>
        @endif
      </table>
      <button class="bg-[#eee] rounded-md py-1 px-2.5 m-1 border border-[#999] shadow-[0_1px_1px_0_rgba(187, 187, 187, 1)]" type="submit">
        {{ $type == 'registration' ? 'Register' : 'Login' }}
      </button>
      @if($type == 'login')
      <input type="checkbox" /> Remember Me
      @endif
      <p>
        {{ $type == 'registration' ? 'Already have an account?' : 'Don\'t have an account?' }}
        <a href="{{ $type == 'registration' ? '/login' : '/register' }}" class="text-blue-700">
          {{ $type == 'registration' ? 'Login' : 'Register' }}
        </a>
      </p>
    </form>
  </div>
</x-layout>