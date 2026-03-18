
import sys, re
from collections import Counter

def tokenize(text):
    return re.findall(r'\w+', text)

def split_sentences(text):
    return [s.strip() for s in re.split(r'(?<=[.!?؟])\s+', text) if s.strip()]

def compute_sentence_scores(sentences, freq, stop_words):
    scores = []
    for s in sentences:
        s_words = tokenize(s.lower())
        score = sum(freq.get(w,0) for w in s_words if w not in stop_words)
        scores.append((s, score))
    return scores

def summarize(text, max_sentences=3):
    sentences = split_sentences(text)
    words = tokenize(text.lower())
    stop_words = set([
        'و','في','على','من','إلى','عن','أن','إن','كما','هذا','هذه','هو','هي',
        'the','and','for','with','a','an','of','to','in','on'
    ])
    freq = Counter([w for w in words if w not in stop_words and len(w)>2])
    scored_sentences = compute_sentence_scores(sentences, freq, stop_words)
    scored_sentences.sort(key=lambda x: x[1], reverse=True)
    top_sentences = [s for s,_ in scored_sentences[:max_sentences]]
    return ' '.join(top_sentences)

if __name__ == "__main__":
    text = sys.stdin.read()
    print(summarize(text))
