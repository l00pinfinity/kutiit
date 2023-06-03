import express from 'express';
import bodyParser from 'body-parser';
import proverbRoutes from './routes/proverbRoutes';

const app = express();
const port = 3000;

app.use(bodyParser.json());

app.use('/api/v1', proverbRoutes);

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});
