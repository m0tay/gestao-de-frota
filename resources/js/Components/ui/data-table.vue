<script setup lang="ts" generic="TData, TValue">
import { Button } from "@/Components/ui/button"
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/Components/ui/table"
import { valueUpdater } from '@/lib/utils'
import type {
    ColumnDef, ColumnFiltersState,
} from '@tanstack/vue-table'
import {
    FlexRender,
    SortingState,
    VisibilityState,
    getCoreRowModel,
    getFilteredRowModel,
    getPaginationRowModel,
    getSortedRowModel,
    useVueTable
} from "@tanstack/vue-table"
import { ref } from 'vue'

const props = defineProps<{
    columns: ColumnDef<TData, TValue>[]
    data: TData[]
}>()

const table = useVueTable({
    get data() {
        return props.data
    },
    get columns() {
        return props.columns
    },
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    onColumnFiltersChange: updaterOrValue => valueUpdater(updaterOrValue, columnFilters),
    getSortedRowModel: getSortedRowModel(),
    onSortingChange: updaterOrValue => valueUpdater(updaterOrValue, sorting),
    onColumnVisibilityChange: updaterOrValue => valueUpdater(updaterOrValue, columnVisibility),
    getFilteredRowModel: getFilteredRowModel(),
    state: {
        get sorting() {
            return sorting.value

        },
        get columnFilters() {
            return columnFilters.value
        },
        get columnVisibility() {
            return columnVisibility.value
        },

    },
    getDefaultColumnOptions: () => ({
        filterable: true,
        filterValue: ''
    }),
    getDefaultFilterOptions: () => ({
        filterMatchMode: 'contains'
    })
})


const sorting = ref<SortingState>([])
const columnFilters = ref<ColumnFiltersState>([])
const columnVisibility = ref<VisibilityState>({})

</script>

<template>
    <!-- <div class="flex items-center py-4">
        <Input class="max-w-sm ml-2" placeholder="Filtrar resultados..."
            :model-value="table.getColumn(table.getAllLeafColumns()[0])?.getFilterValue() as string"
            @update:model-value="table.setGlobalFilter($event)" />
    </div> -->
    <div class="border rounded-md bg-white">
        <Table>
            <TableHeader>
                <TableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
                    <TableHead v-for="header in headerGroup.headers" :key="header.id">
                        <FlexRender v-if="!header.isPlaceholder" :render="header.column.columnDef.header"
                            :props="header.getContext()" />
                    </TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <template v-if="table.getRowModel().rows?.length">
                    <TableRow v-for="row in table.getRowModel().rows" :key="row.id"
                        :data-state="row.getIsSelected() ? 'selected' : undefined">
                        <TableCell v-for="cell in row.getVisibleCells()" :key="cell.id">
                            <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
                        </TableCell>
                    </TableRow>
                </template>
                <template v-else>
                    <TableRow>
                        <TableCell :colSpan="columns.length" class="h-24 text-center">
                            Sem resultados 😰
                        </TableCell>
                    </TableRow>
                </template>
            </TableBody>
        </Table>
        <div class="flex items-center justify-center py-4 space-x-4 px-16">
            <Button variant="outline" size="sm" :disabled="!table.getCanPreviousPage()" @click="table.firstPage()">
                &lt;&lt; Primeira
            </Button>
            <Button variant="outline" size="sm" :disabled="!table.getCanPreviousPage()" @click="table.previousPage()">
                &lt; Anterior
            </Button>
            <Button variant="outline" size="sm" :disabled="!table.getCanNextPage()" @click="table.nextPage()">
                Próxima &gt;
            </Button>
            <Button variant="outline" size="sm" :disabled="!table.getCanNextPage()" @click="table.lastPage()">
                Última &gt;&gt;
            </Button>
            <Button size="sm" disabled variant="outline">Páginas: {{ table.getPageCount() }}</Button>
            <Button size="sm" disabled variant="outline">Resultados: {{ table.getRowCount() }}</Button>
        </div>
    </div>
</template>
