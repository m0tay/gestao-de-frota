import { h } from 'vue'
import {ColumnDef} from "@tanstack/vue-table";
import DropdownAction from '@/Components/ui/data-table-dropdown.vue'
import { ArrowUpDown, ChevronDown } from 'lucide-vue-next'
import {Button} from "@/Components/ui/button";

export const columns: ColumnDef<Vehicle>[] = [
    {
        accessorKey: 'licensePlate',
        header: 'Placa',
    },
    {
        accessorKey: 'brand',
        header: 'Marca',
    },
    {
        accessorKey: 'model',
        header: 'Modelo',
    },
    {
        accessorKey: 'vin',
        header: 'VIN',
    },
    {
        accessorKey: 'lastInspection',
        header: 'Última Inspecção',
        cell: ({ row }) => Intl.DateTimeFormat('pt-PT', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        }).format(row.getValue('lastInspection')),
    },

]
