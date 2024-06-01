import { format } from 'date-fns';
import { ptBR } from 'date-fns/locale';

const isValidDate = (d) => d instanceof Date && !isNaN(d);

// Use this function to safely format the date
export const formatDate = (date) => {
    return isValidDate(date) ? format(date, "EEEEEE, dd 'de' MMMM", { locale: ptBR }) : "Data inválida.";
}