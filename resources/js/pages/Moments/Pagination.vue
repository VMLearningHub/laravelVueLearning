<template>
  <div class="flex gap-2 items-center mt-4 flex-wrap">
    <button
      v-for="link in links"
      :key="link.label"
      :disabled="!link.url"
      @click="changePage(link.url)"
      class="px-3 py-1.5 text-sm rounded-md border"
      :class="{
        'bg-blue-600 text-white font-bold shadow-md': link.active,
        'text-gray-700 hover:bg-gray-100 cursor-pointer': link.url,
        'text-gray-400 cursor-not-allowed': !link.url,
      }"
      v-html="link.label"
    ></button>
  </div>
</template>

<script lang="ts" setup>
interface PaginationLink {
  url: string | null
  label: string
  active: boolean
}

defineProps<{
  links: PaginationLink[]
}>()

const emit = defineEmits<{
  (e: "pageChange", page: number): void
}>()

const changePage = (url: string | null) => {

    if (!url) return
    const page = Number(new URL(url).searchParams.get("page"))

    console.log(page);
    emit("pageChange", page)
}
</script>
