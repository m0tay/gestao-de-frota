import { h } from "vue";
import DropdownAction from "@/Components/ui/data-table-dropdown.vue";
import { ArrowUpDown, ChevronDown } from "lucide-vue-next";
import { Button } from "@/Components/ui/button";
import { formatDate } from "@/lib/formatDate.js";
import { format, parseISO } from "date-fns";
import { ptBR } from "date-fns/locale";

export const columns = [
    {
        accessorKey: "company",
        header: "Empresa",
        headerStyle: {
            textAlign: "center",
        },
        cell: function (row) {
            return h(
                "div",
                { class: "flex items-center" },
                row.getValue("company")
            );
        },
    },
    {
        accessorKey: "code",
        header: "Código",
        headerStyle: {
            textAlign: "center",
        },
        cell: function (row) {
            return h(
                "div",
                { class: "flex items-center" },
                row.getValue("code")
            );
        },
    },
    {
        accessorKey: "pin",
        header: "PIN",
        headerStyle: {
            textAlign: "center",
        },
        cell: function (row) {
            return h(
                "div",
                { class: "flex items-center" },
                row.getValue("pin")
            );
        },
    },
    {
        accessorKey: "type",
        header: "Tipo",
        headerStyle: {
            textAlign: "center",
        },
        cell: function (row) {
            return h(
                "div",
                { class: "flex items-center" },
                row.getValue("type")
            );
        },
    },
    {
        accessorKey: "expire_at",
        header: "Data de Expiração",
        headerStyle: {
            textAlign: "center",
        },
        cell: function (row) {
            return h(
                "div",
                { class: "flex items-center" },
                row.getValue("expire_at")
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
            const vehicle = row.getValue("vehicle");

            return h(
                "div",
                { class: "flex items-center" },
                vehicle ? vehicle : "Nenhum"
            );
        },
    },
];
