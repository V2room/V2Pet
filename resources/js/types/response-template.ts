export interface ResponseTemplate<Data> {
    code: number;
    data: Data;
    message: string;
    errors: Array<any> | object | null;
}
