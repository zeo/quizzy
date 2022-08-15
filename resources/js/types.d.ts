interface User {
    id: string;
    name: string;
}

interface AuthUser extends User {
    email: string;
    has_verified_email: boolean;
}

interface SharedPageProps {
    auth?: {
        user?: AuthUser;
    };
}

interface Quiz {
    id: string;
    name: string;
    is_private: boolean;
    questions?: Question[];
    questions_count?: number;
}

interface Question {
    id: string;
    name: string;
    time_seconds: number;
    order: number;
    answers: Answer[];
}

interface Answer {
    id: string;
    value: string;
    order: number;
    is_correct?: boolean;
}
