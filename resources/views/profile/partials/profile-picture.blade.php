<section class="space-y-6">
  <header>
      <h2 class="text-lg font-medium text-gray-900 dark:text-black">
          {{ __('Profilová fotka') }}
      </h2>
  </header>
  <form action="{{ route('profile.picture') }}" method="post" enctype="multipart/form-data" class="flex flex-col items-center gap-10">
    @csrf
    @method("PATCH")

    @if (Auth::user()->profile_pic_path)
        {{ Auth::user()->profile_pic_path }}
    @endif

    <input type="file" name="photo" id="photo" class="inline-block cursor-pointer p-3">
    

    <div class="flex items-center gap-4">
      <input type="submit" value="Uložiť zmeny" class="p-2 bg-primaryAction rounded-md cursor-pointer">
      @if (session('status') === 'profile-picture-updated')
        <p
          x-data="{ show: true }"
          x-show="show"
          x-transition
          x-init="setTimeout(() => show = false, 2000)"
          class="text-sm text-gray-600 dark:text-gray-400"
        >{{ __('Uložené.') }}</p>
      @endif
    </div>
  </form>
</section>
