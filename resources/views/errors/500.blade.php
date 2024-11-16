<x-client-layout>
  <div class="page-title" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
    <h1>Oops! </h1>
    <p>{{ $exception->getMessage() }}</p>
    <!-- <p>Internal Server Error. Our team will investigate this issue as soon as possible. Please try again later.</p> -->
  </div>
</x-client-layout>