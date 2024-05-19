import { useWindowSize } from '@vueuse/core'
import { ref } from 'vue'

export const { width } = useWindowSize()

export const mobileFoldingWidth = ref(700)

export const minWidthToFold = ref(380)