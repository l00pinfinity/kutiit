import { Request, Response } from 'express';
import { readData, writeData } from '../utils/fileUtils';
import { Proverb } from '../models/Proverb';

export const getAllProverbs = (req: Request, res: Response): void => {
  const data = readData();
  res.json(data);
};

export const getProverbById = (req: Request, res: Response): void => {
  const id = Number(req.params.id); // Convert the id parameter to a number
  const data = readData();
  const proverb = data.find((item: Proverb) => item.id === id);

  if (!proverb) {
    res.sendStatus(404);
  } else {
    res.json(proverb);
  }
};

export const createProverb = (req: Request, res: Response): void => {
  const newProverb: Proverb = req.body;
  const data = readData();
  data.push(newProverb);
  writeData(data);
  res.sendStatus(201);
};

export const updateProverb = (req: Request, res: Response): void => {
  const id = Number(req.params.id); // Convert the id parameter to a number
  const updatedProverb: Proverb = req.body;
  const data = readData();
  const index = data.findIndex((item: Proverb) => item.id === id);

  if (index === -1) {
    res.sendStatus(404);
  } else {
    data[index] = { ...data[index], ...updatedProverb };
    writeData(data);
    res.sendStatus(204);
  }
};

export const deleteProverb = (req: Request, res: Response): void => {
  const id = Number(req.params.id); // Convert the id parameter to a number
  const data = readData();
  const filteredData = data.filter((item: Proverb) => item.id !== id);
  writeData(filteredData);
  res.sendStatus(204);
};
