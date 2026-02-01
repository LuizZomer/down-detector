import { FlashToastListener } from "@/components/feedback/FlashToastListener";
import { Toaster } from "sonner";

export default function AppLayout({ children }: { children: React.ReactNode }) {
    return (
        <>
            <FlashToastListener />
            {children}
            <Toaster position="top-right" />
        </>
    );
}
