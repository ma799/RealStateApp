<template>
  <div
    class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-800 dark:to-gray-900 py-12 px-4 sm:px-6 lg:px-8"
  >
    <div class="max-w-3xl mx-auto text-center">
      <!-- Header Section -->
      <div class="space-y-4 mb-12">
        <h1
          class="text-4xl font-bold text-gray-900 dark:text-white tracking-tight sm:text-5xl"
        >
          Welcome to <span class="text-indigo-600 dark:text-indigo-400">RealEstate</span>
        </h1>
        <h2 class="text-xl text-gray-600 dark:text-gray-300">
          Discover your dream property with our premium listings
        </h2>
      </div>

      <!-- Features Section -->
      <div class="bg-white dark:bg-gray-700 rounded-xl shadow-lg p-6 mb-8">
        <div class="space-y-4">
          <div class="flex items-center">
            <svg
              class="h-6 w-6 text-green-500 mr-3"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 13l4 4L19 7"
              />
            </svg>
            <span class="text-gray-700 dark:text-gray-200"
              >Register to unlock all features</span
            >
          </div>
          <div class="flex items-center">
            <svg
              class="h-6 w-6 text-indigo-500 mr-3"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
              />
            </svg>
            <span class="text-gray-700 dark:text-gray-200"
              >Verify your email for premium access</span
            >
          </div>
        </div>
      </div>

      <!-- Test Accounts Section -->
      <div class="bg-white dark:bg-gray-700 rounded-xl shadow-lg p-6 mb-8">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
          Try our demo accounts
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
          <div class="bg-gray-50 dark:bg-gray-600 p-4 rounded-lg">
            <div class="font-medium text-gray-900 dark:text-white">Account #1</div>
            <div class="text-gray-600 dark:text-gray-300">Email: test@example.com</div>
            <div class="text-gray-600 dark:text-gray-300">Password: password</div>
          </div>
          <div class="bg-gray-50 dark:bg-gray-600 p-4 rounded-lg">
            <div class="font-medium text-gray-900 dark:text-white">Account #2</div>
            <div class="text-gray-600 dark:text-gray-300">Email: test2@example.com</div>
            <div class="text-gray-600 dark:text-gray-300">Password: password</div>
          </div>
        </div>
      </div>

      <!-- CTA Section -->
      <div class="space-y-6">
        <Link
          :href="route('listing.index')"
          class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
        >
          Browse Listings
          <svg
            class="ml-3 -mr-1 h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M9 5l7 7-7 7"
            />
          </svg>
        </Link>

        <Box class="max-w-md mx-auto">
          <div class="text-sm text-gray-500 dark:text-gray-400 text-center">
            <p class="font-medium">Pro Tip:</p>
            <p>Make offers on listings to experience the full negotiation flow</p>
      
          </div>
        </Box>
        <p class="border-b border-gray-400 dark:border-gray-600 w-fit mx-auto text-[12px] pb-1 text-gray-500 dark:text-gray-500">
            + Dark Mode Feature</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import Box from "@/Component/Ui/Box.vue";
import { Link } from "@inertiajs/vue3";
</script>
