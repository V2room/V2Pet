export interface CursorPagination<Model> {
    data: Array<Model>;
    per_page: number;
    next_cursor: string | undefined;
    prev_cursor: string | undefined;
    next_page_url: string | undefined;
    prev_page_url: string | undefined;
}
