/// <reference types="vite/client" />
/// <reference types="@inertiajs/vue3" />

declare module '@inertiajs/vue3' {
    import { DefineComponent } from 'vue';
    export const Link: DefineComponent<{ /* Add props if needed */ }>;
    export const useForm: typeof import('@inertiajs/vue3')['useForm'];
    // Extend other Inertia types as needed

    export const Link: DefineComponent<{
      href: string;
      method?: string;
      as?: string;
      data?: Record<string, any>;
      replace?: boolean;
      preserveScroll?: boolean | ((props: any) => boolean);
      preserveState?: boolean | ((props: any) => boolean);
      only?: string[];
      headers?: Record<string, string>;
      errorBag?: string;
      queryStringArrayFormat?: 'indices' | 'brackets';
    }>;
  
    export const usePage: () => {
      props: {
        [key: string]: any;
      };
    };
  
    export const useForm: typeof import('@inertiajs/vue3')['useForm'];

  }
  // For Inertia.js core
declare module '@inertiajs/core' {
    export * from '@inertiajs/core/types';
  }
  