export class SYSTEM {
    static typeof(data)
    {
        if(Array.isArray(data))
        {
            return 'array';
        }
        return typeof data;
    }
}