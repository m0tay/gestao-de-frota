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
            <Button class="w-full bg-sky-500 hover:bg-sky-400">Entregar</Button>
        </AlertDialogTrigger>
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>Tem certeza disso?</AlertDialogTitle>
<!--                <AlertDialogDescription class="text-pretty">-->
<!--                    Ao entregar a requisição, o condutor será avisado e o seu agendamento será marcado como entregue.-->
<!--                </AlertDialogDescription>-->
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogAction class="w-full p-0 sm:w-fit">
                    <Button class="w-full bg-sky-500 hover:bg-sky-400">Mudei de Ideia</Button>
                </AlertDialogAction>
                <AlertDialogAction class="w-full p-0 sm:w-fit">
                    <Button class="w-full bg-sky-500 hover:bg-sky-400">Listar</Button>
                </AlertDialogAction>

                <AlertDialogAction class="w-full p-0 sm:w-fit">
                    <Button class="w-full bg-sky-500 hover:bg-sky-400">Agendar</Button>
                </AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
