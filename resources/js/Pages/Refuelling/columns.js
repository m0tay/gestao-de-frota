import { h } from 'vue'
import DropdownAction from '@/Components/ui/data-table-dropdown.vue'
import { ArrowUpDown, ChevronDown } from 'lucide-vue-next'
import { Button } from '@/Components/ui/button'

export const columns = [
  {
    accessorKey: 'status',
    header: function (column) {
      return h(Button, {
        variant: 'ghost',
        onClick: function () {
          column.toggleSorting(column.getIsSorted() === 'asc')
        },
      }, [
        'Status',
        h(ArrowUpDown, { class: 'ml-2 h-4 w-4' }),
      ])
    },
    cell: function (row) {
      return h('div', { class: 'capitalize' }, row.getValue('status'))
    },
  },
  {
    accessorKey: 'email',
    header: 'Email',
    cell: function (row) {
      return h('div', { class: 'lowercase' }, row.getValue('email'))
    },
  },
  {
    accessorKey: 'amount',
    header: function () {
      return h('div', { class: 'text-right' }, 'Amount')
    },
    cell: function (row) {
      const amount = Number.parseFloat(row.getValue('amount'))
      const formatted = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
      }).format(amount)

      return h('div', { class: 'text-right font-medium' }, formatted)
    },
  },
  {
    id: 'actions',
    enableHiding: false,
    cell: function (row) {
      const payment = row.original

      return h('div', { class: 'relative' }, h(DropdownAction, { payment }))
    },
  },
]

