import { h } from "vue";
import DropdownAction from "@/Components/ui/data-table-dropdown.vue";
import { ArrowUpDown, ChevronDown } from "lucide-vue-next";
import { Button } from "@/Components/ui/button";

export const columns = [
    {
        accessorKey: "refuel_date",
        header: "Refuel Date",
        cell: function (row) {
            return h(
                "div",
                { class: "flex-1 capitalize" },
                row.getValue("refuel_date").toLocaleDateString()
            );
        },
    },
    {
        accessorKey: "vehicle",
        header: "Vehicle",
        cell: function (row) {
            return h(
                "div",
                { class: "flex-1 capitalize" },
                row.getValue("vehicle").licensePlate
            );
        },
    },
    {
        accessorKey: "driver",
        header: "Driver",
        cell: function (row) {
            return h(
                "div",
                { class: "flex-1 capitalize" },
                row.getValue("driver").name
            );
        },
    },
    {
        accessorKey: "fuel_type",
        header: "Fuel Type",
        cell: function (row) {
            return h(
                "div",
                { class: "flex-1 capitalize" },
                row.getValue("fuel_type")
            );
        },
    },
    {
        accessorKey: "amount",
        header: function () {
            return h("div", { class: "flex-1 text-right" }, "Amount");
        },
        cell: function (row) {
            const amount = Number.parseFloat(row.getValue("amount"));

            return h(
                "div",
                { class: "flex-1 text-right font-medium" },
                amount.toLocaleString() + " L"
            );
        },
    },
    {
        accessorKey: "price",
        header: function () {
            return h("div", { class: "flex-1 text-right" }, "Price");
        },
        cell: function (row) {
            const price = Number.parseFloat(row.getValue("price"));
            const formatted = new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "USD",
            }).format(price);

            return h(
                "div",
                { class: "flex-1 text-right font-medium" },
                formatted
            );
        },
    },
    {
        id: "actions",
        enableHiding: false,
        cell: function (row) {
            const refueling = row.original;

            return h(
                "div",
                { class: "relative flex-1" },
                h(DropdownAction, { refueling })
            );
        },
    },
];
