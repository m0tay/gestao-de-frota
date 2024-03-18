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



const emit = defineEmits(['close'])
</script>

<template>
    <AlertDialog>
        <AlertDialogTrigger>
            <Button class="w-full bg-sky-500 hover:bg-sky-400" >Entregar</Button>
        </AlertDialogTrigger>
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>Tem certeza disso?</AlertDialogTitle>
                <AlertDialogDescription class="text-pretty">
                    Ao entregar a requisição, o condutor será avisado e o seu agendamento será marcado como entregue.
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel>Mudei de Ideia</AlertDialogCancel>
                <AlertDialogAction class="w-full p-0 sm:w-fit" @click="$emit('close')">
                    <Button class="w-full bg-sky-500 hover:bg-sky-400">Entregar</Button>
                </AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
