<script setup>
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/Components/ui/alert-dialog/index.js'
import {Button} from "@/Components/ui/button/index.js";

const emit = defineEmits(['cancel'])
</script>

<template>
    <AlertDialog>
        <AlertDialogTrigger>
            <Button class="w-full" variant="destructive">Cancelar Requisição</Button>
        </AlertDialogTrigger>
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>Tem certeza disso?</AlertDialogTitle>
                <AlertDialogDescription class="text-pretty">
                    Ao cancelar a requisição, o condutor será avisado e o seu agendamento cancelado.
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel>Mudei de Ideia</AlertDialogCancel>
                <AlertDialogAction class="w-full p-0 sm:w-fit" @click="$emit('cancel')">
                    <Button class="w-full" variant="destructive">Cancelar Requisição</Button>
                </AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
