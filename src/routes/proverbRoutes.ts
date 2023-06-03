import express from 'express';
import {
    getAllProverbs,
    getProverbById,
    createProverb,
    updateProverb,
    deleteProverb,
} from '../controllers/proverbController';

const router = express.Router();

router.get('/proverbs', getAllProverbs);
router.get('/proverbs/:id', getProverbById);
router.post('/proverbs', createProverb);
router.put('/proverbs/:id', updateProverb);
router.delete('/proverbs/:id', deleteProverb);

export default router;
