import express, { Request, Response } from 'express';
import bodyParser from 'body-parser';
import fs from 'fs';
import path from 'path';

const app = express();
const port = 3000;

app.use(bodyParser.json());

const dataPath = path.join(__dirname, 'kutiit.json');

// Read data from JSON file
const readData = (): any[] => {
  const data = fs.readFileSync(dataPath, 'utf-8');
  return JSON.parse(data);
};

// Write data to JSON file
const writeData = (data: any[]): void => {
  fs.writeFileSync(dataPath, JSON.stringify(data));
};

// Get all proverbs
app.get('/api/v1/proverbs', (req: Request, res: Response) => {
  const data = readData();
  res.json(data);
});

// Get a specific proverb
app.get('/api/v1/proverbs/:id', (req: Request, res: Response) => {
  const id = req.params.id;
  const data = readData();
  const item = data.find((item: any) => item.id === id);

  if (!item) {
    res.sendStatus(404);
  } else {
    res.json(item);
  }
});

// Create a new proverbs
app.post('/api/v1/proverbs', (req: Request, res: Response) => {
  const newItem = req.body;
  const data = readData();
  data.push(newItem);
  writeData(data);
  res.sendStatus(201);
});

// Update an existing proverbs
app.put('/api/v1/proverbs/:id', (req: Request, res: Response) => {
  const id = req.params.id;
  const updatedItem = req.body;
  const data = readData();
  const index = data.findIndex((item: any) => item.id === id);

  if (index === -1) {
    res.sendStatus(404);
  } else {
    data[index] = { ...data[index], ...updatedItem };
    writeData(data);
    res.sendStatus(204);
  }
});

// Delete an proverbs
app.delete('/api/v1 /proverbs/:id', (req: Request, res: Response) => {
  const id = req.params.id;
  const data = readData();
  const filteredData = data.filter((item: any) => item.id !== id);
  writeData(filteredData);
  res.sendStatus(204);
});

// Start the server
app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});
