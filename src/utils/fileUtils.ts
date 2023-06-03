import fs from 'fs';
import path from 'path';

const dataPath = path.join(__dirname, '../../kutiit.json');

export const readData = (): any[] => {
    const data = fs.readFileSync(dataPath, 'utf-8');
    return JSON.parse(data);
};

export const writeData = (data: any[]): void => {
    fs.writeFileSync(dataPath, JSON.stringify(data));
};
