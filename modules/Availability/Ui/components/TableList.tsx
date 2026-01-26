import { type IAvailability } from "../types/Availability";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";

export const TableList = ({
    availabilities,
}: {
    availabilities: IAvailability[];
}) => (
    <Table>
        <TableHeader>
            <TableRow className="bg-muted/50">
                <TableHead className="font-semibold">Nome</TableHead>
                <TableHead className="font-semibold">Status</TableHead>
                <TableHead className="font-semibold">URL</TableHead>
            </TableRow>
        </TableHeader>

        <TableBody>
            {availabilities.map((availability) => (
                <TableRow key={availability.id}>
                    <TableCell>{availability.name}</TableCell>
                    <TableCell>{availability.monitoringStatus}</TableCell>
                    <TableCell>{availability.url}</TableCell>
                </TableRow>
            ))}
        </TableBody>
    </Table>
);
