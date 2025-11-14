<template>
    <Pagination v-slot="{ page }" :items-per-page="dataval.per_page" :total="dataval.total"
        :default-page="dataval.current_page">

        <PaginationContent v-slot="{ items }">

            <!-- <PaginationPrevious v-if="dataval.prev_page_url" /> -->
            <PaginationFirst v-if="dataval.prev_page_url">
                <Link :href="dataval.first_page_url" preserve-scroll preserve-state>
                    First
                </Link>
            </PaginationFirst>

            <PaginationPrevious v-if="dataval.prev_page_url">
                <Link :href="dataval.prev_page_url" preserve-scroll preserve-state>
                    Previous
                </Link>
            </PaginationPrevious>

            <template v-for="(item, index) in items" :key="index">
                <PaginationItem v-if="item.type === 'page'" :value="item.value" :is-active="item.value === page">
                    <Link :href="`${dataval.path}?page=${item.value}`" preserve-scroll preserve-state >
                    {{ item.value }}
                    </Link>
                </PaginationItem>
            </template>
            <PaginationEllipsis v-if="dataval.last_page > (dataval.current_page + 5)"  />


            <!-- <PaginationNext v-if="dataval.next_page_url" /> -->
             <!-- next page -->
            <PaginationNext v-if="dataval.next_page_url">
                <Link :href="dataval.next_page_url" preserve-scroll preserve-state>
                    Next
                </Link>
            </PaginationNext>

            <!-- last page  -->
            <PaginationLast v-if="dataval.last_page_url">
                <Link :href="dataval.last_page_url" preserve-scroll preserve-state>
                    Last
                </Link>
            </PaginationLast>

        </PaginationContent>
    </Pagination>
</template>

<script setup lang="ts">
import {
    Pagination,
    PaginationContent,
    PaginationEllipsis,
    PaginationItem,
    PaginationNext,
    PaginationPrevious,
    PaginationFirst,
    PaginationLast,
} from "@/components/ui/pagination"
import { Link } from "@inertiajs/vue3";




defineProps({
    dataval: {
        type: Object,
        required: true,
    }
});

</script>
