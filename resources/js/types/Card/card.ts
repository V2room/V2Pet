export interface Card {
    id: number;
    image: string;
    message: string;
    user_id: number | null;
    created_at: string;
    updated_at: string;
}
