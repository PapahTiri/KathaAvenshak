@props(['streak', 'schedule', 'claimedDays' => []])

<div
  x-cloak
  x-show="openModal"
  x-transition
  @keydown.escape.window="openModal = false"
  class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
>
  <div
    class="bg-white dark:bg-gray-800 rounded-2xl p-6 w-11/12 max-w-lg"
    x-data="rewardModal({{ $streak }}, @json($claimedDays))"
  >
    <!-- header -->
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Daily Login Rewards</h2>
      <button @click="openModal = false" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">✕</button>
    </div>

    <!-- grid -->
    <div class="grid grid-cols-3 gap-4">
      @foreach($schedule as $day => $coins)
        <div
          class="p-4 border rounded-lg text-center cursor-pointer"
          :class="{
            'bg-gray-300 text-gray-600 cursor-not-allowed': claimed.includes({{ $day }}),
            'bg-amber-100 border-amber-400': {{ $day }} === streak && !claimed.includes({{ $day }}),
            'bg-gray-50 dark:bg-gray-700': {{ $day }} !== streak && !claimed.includes({{ $day }}),
          }"
          @click="claimReward({{ $day }})"
        >
          <div class="text-sm font-medium">
            Hari ke-{{ $day }}
          </div>
          <template x-if="claimed.includes({{ $day }})">
            <div class="mt-1 text-md font-semibold text-gray-600">Diambil</div>
          </template>
          <template x-if="!claimed.includes({{ $day }})">
            <div class="mt-1 text-lg font-bold text-gray-800 dark:text-gray-100 flex items-center justify-center gap-1">
              {{ $coins }}
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-5 h-5 flex items-center gap-1 text-yellow-500">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125"/>
              </svg>
            </div>
          </template>
        </div>
      @endforeach
    </div>
  </div>
</div>

<script>
  function rewardModal(streak, claimedDays) {
    return {
      streak: streak,
      claimed: claimedDays,

      claimReward(day) {
        if (this.claimed.includes(day) || day !== this.streak) return;

        fetch('/claim-reward', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
          body: JSON.stringify({ day }),
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            this.claimed.push(day);
          }
        });
      },
    }
  }
</script>
