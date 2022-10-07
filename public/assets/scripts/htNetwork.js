export class HtNetwork {
    static async post(path, datas, execute = (e) => { }, error = (e) => console.error(e)) {
        try {
            const form = new FormData();
            for (let data in datas) {
                form.append(data, datas[data]);
            }
            const fetchResult = await fetch(path, {
                method: 'POST',
                body: form
            });
            const jsonData = await fetchResult.json();
            execute(jsonData);
        }
        catch (e) {
            error(e);
        }
    }
    static async getJSON(path, execute, error = (e) => console.error(e)) {
        try {
            const fetchResult = await fetch(path);
            const jsonData = await fetchResult.json();
            execute(jsonData);
        }
        catch (e) {
            error(e);
        }
    }
    static async postJSON(path, datas, execute = (e) => { }, error = (e) => console.error(e)) {
        try {
            const fetchResult = await fetch(path, {
                method: 'POST',
                body: JSON.stringify(datas),
                headers: {
                    "Accept": "application/json",
                    "Content-type": "application/json"
                }
            });
            const jsonData = await fetchResult.json();
            execute(jsonData);
        }
        catch (e) {
            error(e);
        }
    }
}