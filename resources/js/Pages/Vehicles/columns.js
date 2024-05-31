import { h } from "vue";
import DropdownAction from "@/Components/ui/data-table-dropdown.vue";
import { ArrowUpDown, ChevronDown } from "lucide-vue-next";
import { Button } from "@/Components/ui/button";

export const columns = [
    {
        accessorKey: "plate",
        header: "Placa",
        cell: ({ row }) =>
            h(
                "div",
                { class: "flex items-center whitespace-nowrap" },
                row.getValue("plate").toUpperCase()
            ),
    },
    {
        accessorKey: "brand",
        header: "Marca",
        cell: ({ row }) =>
            h(
                "div",
                { class: "flex items-center" },
                row.getValue("brand")
            ),
    },
    {
        accessorKey: "model",
        header: "Modelo",
        cell: ({ row }) =>
            h(
                "div",
                { class: "flex items-center" },
                row.getValue("model")
            ),
    },
    {
        accessorKey: "color",
        header: "Cor",
        cell: ({ row }) =>
            h(
                "div",
                { class: "flex items-center" },
                row.getValue("color")
            ),
    },
    {
        accessorKey: "proprietary",
        header: "Proprietário",
        cell: ({ row }) =>
            h(
                "div",
                { class: "flex items-center" },
                row.getValue("proprietary")
            ),
    },
    {
        accessorKey: "kms",
        header: "Quilometragem",
        cell: ({ row }) =>
            h(
                "div",
                { class: "flex items-center whitespace-nowrap" },
                row.getValue("kms")
            ),
    },
    {
        accessorKey: "category",
        header: "Categoria",
        cell: ({ row }) =>
            h(
                "div",
                { class: "flex items-center" },
                row.getValue("category")
            ),
    },
    {
        accessorKey: "active",
        header: "Estado",
        cell: ({ row }) =>
            h(
                "div",
                { class: "flex items-center" },
                row.getValue("active")
            ),
    },
    {
        accessorKey: "private",
        header: "Tipo de Veículo",
        cell: ({ row }) =>
            h(
                "div",
                { class: "flex items-center" },
                row.getValue("private")
            ),
    },
    {
        accessorKey: "fuel_type",
        header: "Tipo de Combustível",
        cell: ({ row }) =>
            h(
                "div",
                { class: "flex items-center" },
                row.getValue("fuel_type")
            ),
    },
    {
        accessorKey: "status",
        header: "Status",
        cell: ({ row }) =>
            h(
                "div",
                { class: "flex items-center" },
                row.getValue("status")
            ),
    },
];


