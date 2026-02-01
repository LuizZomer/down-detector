import { Button } from "@/components/ui/button";
import { type IAvailability } from "../types/Availability";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import { Pencil, Trash } from "lucide-react";
import { Badge } from "@/components/ui/badge";
import { statusLabelFormatter } from "../utils/statusLabelFormatter";
import { DeleteAvailabilityPopover } from "./popovers/DeleteAvailabilityPopover";

export const TableList = ({
    availabilities,
}: {
    availabilities: IAvailability[];
}) => (
    <Table>
        <TableHeader>
            <TableRow className="bg-muted/50">
                <TableHead scope="col" className="font-semibold">
                    Nome do monitor
                </TableHead>
                <TableHead scope="col" className="font-semibold">
                    URL monitorada
                </TableHead>
                <TableHead scope="col" className="font-semibold">
                    Status atual
                </TableHead>
                <TableHead scope="col" className="font-semibold">
                    Alerta por e-mail
                </TableHead>
                <TableHead scope="col" className="font-semibold">
                    Última verificação
                </TableHead>
                <TableHead scope="col" className="font-semibold">
                    Tempo de resposta
                </TableHead>
                <TableHead scope="col" className="font-semibold">
                    Intervalo de monitoramento
                </TableHead>
                <TableHead scope="col" className="font-semibold">
                    Ações
                </TableHead>
            </TableRow>
        </TableHeader>

        <TableBody>
            {availabilities.map((availability) => {
                const status = statusLabelFormatter(
                    availability.monitoringStatus,
                );

                return (
                    <TableRow key={availability.id}>
                        <TableCell>{availability.name}</TableCell>
                        <TableCell>{availability.url}</TableCell>
                        <TableCell>
                            <Badge className={status.bgColor}>
                                {status.label}
                            </Badge>
                        </TableCell>
                        <TableCell>
                            {availability.errorSendEmail ? (
                                <Badge>Enviar</Badge>
                            ) : (
                                <Badge>Não enviar</Badge>
                            )}
                        </TableCell>
                        <TableCell>
                            {availability.lastCheckedAt ?? "-"}
                        </TableCell>
                        <TableCell>
                            {availability.lastResponseTimeMs ?? "-"}
                        </TableCell>
                        <TableCell>{availability.frequencySeconds}s</TableCell>
                        <TableCell>
                            <div className="flex gap-2">
                                <Button size="icon" className="bg-green-900">
                                    <Pencil />
                                </Button>
                                <DeleteAvailabilityPopover
                                    title={availability.name}
                                    id={availability.id}
                                />
                            </div>
                        </TableCell>
                    </TableRow>
                );
            })}
        </TableBody>
    </Table>
);
