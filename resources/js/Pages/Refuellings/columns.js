import { h } from "vue";
import DropdownAction from "@/Components/ui/data-table-dropdown.vue";
import { ArrowUpDown, ChevronDown } from "lucide-vue-next";
import { Button } from "@/Components/ui/button";

export const columns = [
    {
        accessorKey: "refuel_date",
        header: "Data do Abastecimento",
        headerStyle: {
            textAlign: "center",
        },
        cell: function (row) {
            return h(
                "div",
                { class: "flex justify-center items-center" },
                row.getValue("refuel_date").toLocaleDateString()
            );
        },
    },
    {
        accessorKey: "vehicle",
        header: "Veículo",
        headerStyle: {
            textAlign: "center",
        },
        cell: function (row) {
            return h(
                "div",
                { class: "flex justify-center items-center" },
                row.getValue("vehicle").licensePlate
            );
        },
    },
    {
        accessorKey: "driver",
        header: "Condutor",
        headerStyle: {
            textAlign: "center",
        },
        cell: function (row) {
            return h(
                "div",
                { class: "flex justify-center items-center" },
                row.getValue("driver").name
            );
        },
    },
    {
        accessorKey: "fuel_type",
        header: "Tipo de Combustível",
        headerStyle: {
            textAlign: "center",
        },
        cell: function (row) {
            return h(
                "div",
                { class: "flex justify-center items-center" },
                row.getValue("fuel_type")
            );
        },
    },
    {
        accessorKey: "liters",
        header: "Quantidade",
        headerStyle: {
            textAlign: "center",
        },
        cell: function (row) {
            const amount = Number.parseFloat(row.getValue("liters"));

            return h(
                "div",
                { class: "flex justify-center items-center" },
                amount.toLocaleString() + " L"
            );
        },
    },
    {
        accessorKey: "price",
        header: "Preço",
        headerStyle: {
            textAlign: "center",
        },
        cell: function (row) {
            const price = Number.parseFloat(row.getValue("price"));
            const formatted = new Intl.NumberFormat("pt-PT", {
                style: "currency",
                currency: "EUR",
            }).format(price);

            return h(
                "div",
                { class: "flex justify-center items-center" },
                formatted
            );
        },
    },
    {
        accessorKey: "total",
        header: "Total",
        headerStyle: {
            textAlign: "center",
        },
        cell: function (row) {
            const total = Number.parseFloat(row.getValue("total"));
            const formatted = new Intl.NumberFormat("pt-PT", {
                style: "currency",
                currency: "EUR",
            }).format(total);

            return h(
                "div",
                { class: "flex justify-center items-center" },
                formatted
            );
        },
    },
    {
        id: "actions",
        enableHiding: false,
        headerStyle: {
            textAlign: "center",
        },
        cell: function (row) {
            const refueling = row.original;

            return h(
                "div",
                { class: "flex justify-center items-center" },
                h(DropdownAction, { refueling })
            );
        },
    },
];

